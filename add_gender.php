<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'users_db');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu người dùng chọn giới tính
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gender'])) {
    $gender = $_POST['gender'];

    // Thêm vào bảng users
    $sql = "INSERT INTO users (gender) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gender);

    if ($stmt->execute()) {
        echo "Đã thêm giới tính: $gender vào cơ sở dữ liệu.";
    } else {
        echo "Lỗi khi thêm: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>