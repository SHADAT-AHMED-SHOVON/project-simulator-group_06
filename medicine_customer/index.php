<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    
    if(isset($_GET['page']) && strpos($_GET['page'], 'api_') !== false) {
        die(json_encode(['success' => false, 'message' => 'Please login first!']));
    }
    header("Location: /medicine_shovon/index.php?page=login");
    exit;
}

require 'config.php';
require 'models.php';
require 'controllers.php';

$page = $_GET['page'] ?? 'home';

if ($page === 'api_cart_add') { apiAddToCart($conn); }
elseif ($page === 'api_cart_update') { apiUpdateCart($conn); }
elseif ($page === 'api_cart_remove') { apiRemoveCart($conn); }

if ($page === 'home') { homeController($conn); }
elseif ($page === 'cart') { cartController($conn); }
elseif ($page === 'payment') { paymentController($conn); }
elseif ($page === 'success') { successController($conn); }
elseif ($page === 'orders') { ordersController($conn); }
elseif ($page === 'view_invoice') { viewInvoiceController($conn); }
elseif ($page === 'cancel_order') { cancelOrderController($conn); }
else { echo "<h2>404 Not Found</h2>"; }
?>