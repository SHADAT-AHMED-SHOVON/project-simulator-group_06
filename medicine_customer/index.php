<?php
session_start();

// --- FAKE LOGIN FOR TASK 3 TESTING ---
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Assuming User ID 1 is a valid customer
    $_SESSION['role'] = 'customer';
    $_SESSION['name'] = 'Rahim (Test Customer)';
}
// -------------------------------------

require 'config.php';
require 'models.php';
require 'controllers.php';

$page = $_GET['page'] ?? 'home';

// --- API ROUTES (AJAX) ---
if ($page === 'api_cart_add') { apiAddToCart($conn); }
elseif ($page === 'api_cart_update') { apiUpdateCart($conn); }
elseif ($page === 'api_cart_remove') { apiRemoveCart($conn); }

// --- PAGE ROUTES ---
// --- PAGE ROUTES ---
if ($page === 'home') { homeController($conn); }
elseif ($page === 'cart') { cartController($conn); }
elseif ($page === 'payment') { paymentController($conn); }
elseif ($page === 'success') { successController($conn); }
elseif ($page === 'orders') { ordersController($conn); }
elseif ($page === 'view_invoice') { viewInvoiceController($conn); }
elseif ($page === 'cancel_order') { cancelOrderController($conn); }
else { echo "<h2>404 Not Found</h2>"; }
?>