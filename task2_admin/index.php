<?php
session_start();
require 'config.php';
require 'models.php';
require 'controllers.php';

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'admin';
    $_SESSION['user_id'] = 1;
}

$page = $_GET['page'] ?? 'admin_dashboard';

switch ($page) {
    case 'admin_dashboard':
        admin_dashboardCtrl($conn);
        break;
    case 'admin_categories':
        admin_categoryCtrl($conn);
        break;
    case 'admin_medicines':
        admin_medicineCtrl($conn);
        break;
    case 'admin_customers':
        admin_customerCtrl($conn);
        break;
    case 'admin_orders':
        admin_orderCtrl($conn);
        break;
    default:
        echo "Page Not Found";
}
?>