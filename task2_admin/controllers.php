<?php
function admin_dashboardCtrl($conn) {
    $stats = admin_getDashboardStats($conn);
    require 'views/admin_dashboard.php';
}

function admin_categoryCtrl($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        admin_addCategory($conn, $_POST['name'], $_POST['type']);
        header("Location: index.php?page=admin_categories"); exit;
    }
    $categories = admin_getCategories($conn);
    require 'views/admin_categories.php';
}

function admin_medicineCtrl($conn) {
    // 1. Delete Logic
    if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    $delete_query = mysqli_query($conn, "DELETE FROM medicines WHERE id = $delete_id");
    
    if ($delete_query) {
        header("Location: index.php?page=admin_medicines");
        exit;
    } else {
        echo "<script>alert('Failed to delete medicine! It might be linked to an existing order.');</script>";
    }
}

    // 2. Update Logic (Edit Price, Stock, Image)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_medicine'])) {
        $img = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $img = "med_" . time() . ".jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], 'public/uploads/medicines/' . $img);
        }
        admin_updateMedicinePartial($conn, $_POST['med_id'], $_POST['price'], $_POST['stock'], $img);
        header("Location: index.php?page=admin_medicines"); exit;
    }

    // 3. Add New Medicine Logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_medicine'])) {
        $img = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $img = "med_" . time() . ".jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], 'public/uploads/medicines/' . $img);
        }
        admin_addMedicine($conn, $_POST['name'], $_POST['category_id'], $_POST['vendor'], $_POST['price'], $_POST['stock'], $_POST['desc'], $img);
        header("Location: index.php?page=admin_medicines"); exit;
    }

    // Fetch single medicine if Edit button is clicked
    $edit_data = null;
    if (isset($_GET['edit_id'])) {
        $edit_data = admin_getMedicineById($conn, $_GET['edit_id']);
    }

    $medicines = admin_getMedicines($conn);
    $categories = admin_getCategories($conn);
    require 'views/admin_medicines.php';
}

function admin_customerCtrl($conn) {
    if (isset($_GET['delete_id'])) {
        admin_deleteCustomer($conn, $_GET['delete_id']);
        header("Location: index.php?page=admin_customers"); exit;
    }
    $customers = admin_getCustomers($conn);
    require 'views/admin_customers.php';
}

function admin_orderCtrl($conn) {
    if (isset($_GET['ajax_status'])) {
        admin_updateOrder($conn, $_POST['order_id'], $_POST['status']);
        echo json_encode(['success' => true]);
        exit;
    }
    $orders = admin_getOrders($conn);
    require 'views/admin_orders.php';
}
?>