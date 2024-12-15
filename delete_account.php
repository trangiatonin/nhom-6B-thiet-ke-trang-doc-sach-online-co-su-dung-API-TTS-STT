<?php
session_start();

// Thông tin kết nối MySQL
$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "users_db"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Lấy ID người dùng từ session
$user_id = $_SESSION['users_id'];

// Kiểm tra nếu có yêu cầu xóa tài khoản
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xóa tài khoản trong cơ sở dữ liệu
    $sql = "DELETE FROM users WHERE users_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Xóa thành công, hủy session và chuyển hướng người dùng
        session_destroy();
        header("Location: index.php"); // Chuyển đến trang chính
        exit();
    } else {
        // Xảy ra lỗi khi xóa
        echo "Có lỗi xảy ra. Không thể xóa tài khoản.";
    }
}

// Đóng kết nối
$conn->close();
?>