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

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    $cookie_user_id = mysqli_real_escape_string($conn, $_COOKIE['remember_user']);
    $user_query = mysqli_query($conn, "SELECT id, name, role FROM users WHERE id = '$cookie_user_id'");
    
    if ($user_query && mysqli_num_rows($user_query) > 0) {
        $user = mysqli_fetch_assoc($user_query);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['last_activity'] = time(); 
    }
}


$page = $_GET['page'] ?? 'home';

// Routing
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

    setcookie('remember_user', '', time() - 3600, '/'); 
    
    header("Location: index.php?page=home");
    exit;
} else {
    echo "<h2 style='text-align:center; margin-top:50px;'>404 - Page Not Found!</h2>";
}
?>