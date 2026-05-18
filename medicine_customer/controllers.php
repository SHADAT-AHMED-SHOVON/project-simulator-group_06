<?php
// --- AJAX APIs ---
function apiAddToCart($conn) {
    header('Content-Type: application/json');
    $user_id = $_SESSION['user_id'];
    $med_id = $_POST['medicine_id'] ?? 0;
    $qty = $_POST['quantity'] ?? 1;
    
    if ($med_id > 0 && addToCart($conn, $user_id, $med_id, $qty)) {
        echo json_encode(['success' => true, 'message' => 'Added to cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add']);
    }
    exit;
}

function apiUpdateCart($conn) {
    header('Content-Type: application/json');
    $cart_id = $_POST['cart_id'] ?? 0;
    $qty = $_POST['quantity'] ?? 1;
    
    if ($cart_id > 0 && $qty > 0) {
        updateCartQty($conn, $cart_id, $qty);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

function apiRemoveCart($conn) {
    header('Content-Type: application/json');
    $cart_id = $_POST['cart_id'] ?? 0;
    
    if ($cart_id > 0 && removeFromCart($conn, $cart_id)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

// --- Page Controllers ---
function cartController($conn) {
    $user_id = $_SESSION['user_id'];
    $cart_items = getCartItems($conn, $user_id);
    
    $total_price = 0;
    foreach($cart_items as $item) {
        $total_price += ($item['price'] * $item['quantity']);
    }
    
    require 'views/cart.php';
}

// --- Page Controllers ---
// --- Page Controllers ---
function homeController($conn) {
    // Fetch all categories and medicines
    $categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories"), MYSQLI_ASSOC);
    $medicines = mysqli_fetch_all(mysqli_query($conn, "SELECT m.*, c.name as category_name, c.category_type FROM medicines m JOIN categories c ON m.category_id = c.id ORDER BY m.id DESC"), MYSQLI_ASSOC);
    
    // Get total cart items for the badge
    $user_id = $_SESSION['user_id'];
    $cart_count_query = mysqli_query($conn, "SELECT SUM(quantity) as total_qty FROM cart WHERE user_id = $user_id");
    $cart_count_data = mysqli_fetch_assoc($cart_count_query);
    $cart_count = $cart_count_data['total_qty'] ?? 0;

    require 'views/home.php';
}

function checkoutController($conn) {
    $user_id = $_SESSION['user_id'];
    $cart_items = getCartItems($conn, $user_id);
    if(empty($cart_items)) { header("Location: index.php?page=cart"); exit; }
    
    // Fetch user address
    $user_query = mysqli_query($conn, "SELECT address FROM users WHERE id = $user_id");
    $user = mysqli_fetch_assoc($user_query);
    $address = $user['address'] ?? '';
    
    require 'views/checkout.php';
}

function invoiceController($conn) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['shipping_address'] = $_POST['address'];
    }
    $user_id = $_SESSION['user_id'];
    $cart_items = getCartItems($conn, $user_id);
    if(empty($cart_items)) { header("Location: index.php?page=cart"); exit; }
    
    $total_price = 0;
    foreach($cart_items as $item) { $total_price += ($item['price'] * $item['quantity']); }
    require 'views/invoice.php';
}

function paymentController($conn) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['shipping_address'] = $_POST['address']; // Save address from cart page
    }
    require 'views/payment.php';
}

function successController($conn) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
        $payment_method = $_POST['payment_method'];
        $address = $_SESSION['shipping_address'] ?? 'Address not provided'; 

        // 1. Get Cart & Total
        $cart_items = getCartItems($conn, $user_id);
        if(empty($cart_items)) { header("Location: index.php?page=home"); exit; }
        
        $total = 0; 
        foreach($cart_items as $i) {
            $total += ($i['price'] * $i['quantity']);
        }

        // 2. Safe Insert into `orders`
        $address_safe = mysqli_real_escape_string($conn, $address);
        $payment_safe = mysqli_real_escape_string($conn, $payment_method);

        $sql_order = "INSERT INTO orders (user_id, total_amount, shipping_address, status, payment_method) 
                      VALUES ($user_id, $total, '$address_safe', 'pending', '$payment_safe')";
        
        if (!mysqli_query($conn, $sql_order)) {
            die("Database Error: " . mysqli_error($conn)); // Blank page এর বদলে Error দেখাবে
        }
        $order_id = mysqli_insert_id($conn);

        // 3. Insert `order_items`, Update Stock & Get Medicine List
        $ordered_medicines = [];
        foreach($cart_items as $item) {
            $med_id = $item['medicine_id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            
            // For showing on success page
            $ordered_medicines[] = $item['name'] . " (x" . $qty . ")";

            mysqli_query($conn, "INSERT INTO order_items (order_id, medicine_id, quantity, unit_price) VALUES ($order_id, $med_id, $qty, $price)");
            mysqli_query($conn, "UPDATE medicines SET availability = availability - $qty WHERE id = $med_id");
        }
        $medicine_list_string = implode(", ", $ordered_medicines);

        // 4. Insert `payments`
        $txn_id = "TXN" . time() . rand(1000,9999);
        mysqli_query($conn, "INSERT INTO payments (order_id, amount, payment_method, transaction_id) VALUES ($order_id, $total, '$payment_safe', '$txn_id')");

        // 5. Clear Cart & Session Address
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");
        unset($_SESSION['shipping_address']);

        require 'views/success.php';
    } else {
        header("Location: index.php?page=cart");
        exit;
    }
}

function ordersController($conn) {
    $user_id = $_SESSION['user_id'];
    $orders = getUserOrders($conn, $user_id);
    require 'views/orders.php';
}

// View Past Invoice
function viewInvoiceController($conn) {
    $user_id = $_SESSION['user_id'];
    $order_id = $_GET['id'] ?? 0;
    $order = getOrderDetails($conn, $order_id, $user_id);
    if(!$order) { header("Location: index.php?page=orders"); exit; }
    require 'views/invoice.php';
}

// Cancel Order
function cancelOrderController($conn) {
    $user_id = $_SESSION['user_id'];
    $order_id = $_GET['id'] ?? 0;
    cancelOrder($conn, $order_id, $user_id);
    header("Location: index.php?page=orders");
    exit;
}
?>