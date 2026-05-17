<?php

function admin_getDashboardStats($conn) {
    return [
        'medicines' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM medicines"))['c'],
        'categories' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM categories"))['c'],
        'customers' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM users WHERE role='customer'"))['c'],
        'orders' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders WHERE status='pending'"))['c']
    ];
}


function admin_getCategories($conn) {
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC"), MYSQLI_ASSOC);
}
function admin_addCategory($conn, $name, $type) {
    $stmt = mysqli_prepare($conn, "INSERT INTO categories (name, category_type) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ss', $name, $type);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $res;
}


function admin_getMedicines($conn) {
    return mysqli_fetch_all(mysqli_query($conn, "SELECT m.*, c.name as cat_name FROM medicines m JOIN categories c ON m.category_id = c.id ORDER BY m.id DESC"), MYSQLI_ASSOC);
}
function admin_addMedicine($conn, $name, $cat_id, $vendor, $price, $stock, $desc, $img) {
    $stmt = mysqli_prepare($conn, "INSERT INTO medicines (name, category_id, vendor_name, price, availability, description, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sisdiss', $name, $cat_id, $vendor, $price, $stock, $desc, $img);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $res;
}
function admin_deleteMedicine($conn, $id) {
    $check = mysqli_query($conn, "SELECT oi.id FROM order_items oi JOIN orders o ON oi.order_id = o.id WHERE oi.medicine_id = $id AND o.status = 'pending'");
    if(mysqli_num_rows($check) > 0) return false;
    $stmt = mysqli_prepare($conn, "DELETE FROM medicines WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $res;
}


function admin_getCustomers($conn) {
    return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM users WHERE role='customer' ORDER BY id DESC"), MYSQLI_ASSOC);
}
function admin_deleteCustomer($conn, $id) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = $id");
    mysqli_query($conn, "DELETE FROM orders WHERE user_id = $id");
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $res;
}
function admin_getOrders($conn) {
    return mysqli_fetch_all(mysqli_query($conn, "SELECT o.*, u.name as customer_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.id DESC"), MYSQLI_ASSOC);
}
function admin_updateOrder($conn, $id, $status) {
    $stmt = mysqli_prepare($conn, "UPDATE orders SET status = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $res;
}


function admin_getMedicineById($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM medicines WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $res;
}


function admin_updateMedicinePartial($conn, $id, $price, $stock, $img = null) {
    if ($img) {
        $stmt = mysqli_prepare($conn, "UPDATE medicines SET price=?, availability=?, image_path=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'disi', $price, $stock, $img, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE medicines SET price=?, availability=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'dii', $price, $stock, $id);
    }
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $res;
}
?>