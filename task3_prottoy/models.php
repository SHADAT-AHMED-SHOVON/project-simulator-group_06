<?php
// Get all cart items for a user
function getCartItems($conn, $user_id) {
    $sql = "SELECT c.*, m.name, m.vendor_name, m.price, m.image_path, m.availability 
            FROM cart c JOIN medicines m ON c.medicine_id = m.id 
            WHERE c.user_id = $user_id";
    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

// Add item to cart
function addToCart($conn, $user_id, $med_id, $qty) {
    // Check if already in cart
    $check = mysqli_query($conn, "SELECT id, quantity FROM cart WHERE user_id=$user_id AND medicine_id=$med_id");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $new_qty = $row['quantity'] + $qty;
        return mysqli_query($conn, "UPDATE cart SET quantity=$new_qty WHERE id=".$row['id']);
    } else {
        return mysqli_query($conn, "INSERT INTO cart (user_id, medicine_id, quantity) VALUES ($user_id, $med_id, $qty)");
    }
}

// Update quantity
function updateCartQty($conn, $cart_id, $qty) {
    return mysqli_query($conn, "UPDATE cart SET quantity=$qty WHERE id=$cart_id");
}

// Remove from cart
function removeFromCart($conn, $cart_id) {
    return mysqli_query($conn, "DELETE FROM cart WHERE id=$cart_id");
}

// Get all orders for a user
function getUserOrders($conn, $user_id) {
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC"), MYSQLI_ASSOC);
}

// Get single order details with items
function getOrderDetails($conn, $order_id, $user_id) {
    $order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id"));
    if(!$order) return null;
    
    $items = mysqli_fetch_all(mysqli_query($conn, "SELECT oi.*, m.name FROM order_items oi JOIN medicines m ON oi.medicine_id = m.id WHERE oi.order_id = $order_id"), MYSQLI_ASSOC);
    $order['items'] = $items;
    return $order;
}

// Cancel Order
// Cancel Order
function cancelOrder($conn, $order_id, $user_id) {
    // First get the items to restore stock
    $items = mysqli_fetch_all(mysqli_query($conn, "SELECT medicine_id, quantity FROM order_items WHERE order_id = $order_id"), MYSQLI_ASSOC);
    foreach($items as $item) {
        mysqli_query($conn, "UPDATE medicines SET availability = availability + {$item['quantity']} WHERE id = {$item['medicine_id']}");
    }
    // Update order status to 'rejected' (as per DB schema)
    return mysqli_query($conn, "UPDATE orders SET status = 'rejected' WHERE id = $order_id AND user_id = $user_id");
}
?>