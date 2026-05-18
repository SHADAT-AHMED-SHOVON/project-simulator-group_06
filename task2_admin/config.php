<?php
$conn = mysqli_connect('localhost', 'root', '', 'online_medicine_db');
if (!$conn) { die('DB Connection Failed: ' . mysqli_connect_error()); }
mysqli_set_charset($conn, 'utf8mb4');
?>