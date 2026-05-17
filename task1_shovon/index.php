<?php
session_set_cookie_params(0);
session_start();

$timeout_duration = 3600;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();     
    session_destroy();   
    header("Location: index.php?page=login"); 
    exit;
}

if (isset($_SESSION['user_id'])) {
    $_SESSION['last_activity'] = time();
}

require 'config.php';
require 'models.php';
require 'controllers.php';

$page = $_GET['page'] ?? 'home';

if ($page === 'home') {
    homeController($conn);
} elseif ($page === 'login') {
    loginController($conn);
} elseif ($page === 'register') {
    registerController($conn);
} elseif ($page === 'profile') {
    profileController($conn);
} elseif ($page === 'logout') {
    session_unset();
    session_destroy();
    header("Location: index.php?page=home");
    exit;
} else {
    echo "<h2 style='text-align:center; margin-top:50px;'>404 - Page Not Found!</h2>";
}
?>