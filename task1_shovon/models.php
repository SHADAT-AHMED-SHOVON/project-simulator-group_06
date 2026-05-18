<?php
function registerUser($conn, $name, $email, $password, $address, $phone, $role) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password_hash, role, address, phone) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $email, $hash, $role, $address, $phone);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function loginUser($conn, $email, $password) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    
    if ($row && password_verify($password, $row['password_hash'])) {
        return $row;
    }
    return false;
}

function getUserById($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $result;
}

function updateProfile($conn, $id, $name, $email, $address, $phone, $profile_picture = null) {
    if ($profile_picture) {
        $stmt = mysqli_prepare($conn, "UPDATE users SET name=?, email=?, address=?, phone=?, profile_picture=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $email, $address, $phone, $profile_picture, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE users SET name=?, email=?, address=?, phone=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $address, $phone, $id);
    }
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function updatePassword($conn, $id, $new_password) {
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "UPDATE users SET password_hash=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'si', $hash, $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}
?>