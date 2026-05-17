<?php
function registerController($conn) {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

        if (strlen($password) < 8) {
            $error = "Password must be at least 8 characters.";
        } else {
            if (registerUser($conn, $name, $email, $password, $address, $phone, $role)) {
                header("Location: index.php?page=login");
                exit;
            } else {
                $error = "Registration failed! Email might already exist.";
            }
        }
    }
    require 'views/register.php';
}

function loginController($conn) {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = loginUser($conn, $email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php?page=home");
            exit;
        } else {
            $error = "Invalid email or password!";
        }
    }
    require 'views/login.php';
}

function homeController($conn) {
    $categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories"), MYSQLI_ASSOC);
    
    $medicines = mysqli_fetch_all(mysqli_query($conn, "SELECT m.*, c.name as category_name, c.category_type FROM medicines m JOIN categories c ON m.category_id = c.id ORDER BY m.id DESC"), MYSQLI_ASSOC);
    
    $current_user = null;
    if(isset($_SESSION['user_id'])) {
        $current_user = getUserById($conn, $_SESSION['user_id']);
    }
    
    require 'views/home.php';
}

function profileController($conn) {
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
    }

    $error = '';
    $success = '';
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update_profile'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $profile_picture = null;

            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['profile_picture']['tmp_name'];
                $file_name = $_FILES['profile_picture']['name'];
                $file_size = $_FILES['profile_picture']['size'];
                $file_type = $_FILES['profile_picture']['type'];

                $allowed_types = ['image/jpeg', 'image/png'];
                if (in_array($file_type, $allowed_types) && $file_size <= 2097152) {
                    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $new_file_name = "user_" . $user_id . "_" . time() . "." . $ext;
                    $destination = 'public/uploads/' . $new_file_name;
                    if (move_uploaded_file($file_tmp, $destination)) {
                        $profile_picture = $new_file_name;
                    }
                } else {
                    $error = "Invalid image type (JPEG/PNG only) or size (>2MB).";
                }
            }

            if (empty($error)) {
                if (updateProfile($conn, $user_id, $name, $email, $address, $phone, $profile_picture)) {
                    $_SESSION['name'] = $name;
                    $success = "Profile updated successfully!";
                } else {
                    $error = "Profile update failed.";
                }
            }
        } 
        elseif (isset($_POST['change_password'])) {
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            
            $user = getUserById($conn, $user_id);
            if (password_verify($current_password, $user['password_hash'])) {
                 if(strlen($new_password) >= 8) {
                     updatePassword($conn, $user_id, $new_password);
                     $success = "Password changed successfully!";
                 } else {
                     $error = "New password must be at least 8 characters.";
                 }
            } else {
                $error = "Current password is incorrect.";
            }
        }
    }

    $user_data = getUserById($conn, $user_id);
    require 'views/profile.php';
}
?>