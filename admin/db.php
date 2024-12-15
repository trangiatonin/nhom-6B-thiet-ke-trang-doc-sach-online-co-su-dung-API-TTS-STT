<?php
$servername = "localhost";
$username = "root";
$password = "";

// Kết nối với book_storage
$conn = new mysqli($servername, $username, $password, "book_storage");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối với book_storage thất bại: " . $conn->connect_error);
}

?>