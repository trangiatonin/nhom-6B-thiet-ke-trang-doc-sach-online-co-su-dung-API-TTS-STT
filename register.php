<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;

    // Kiểm tra nếu mật khẩu và xác nhận mật khẩu khớp
    if ($password === $confirm_password) {
        // Lưu mật khẩu trực tiếp mà không băm
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "Tài khoản đã được đăng ký thành công!";
        } else {
            echo "Lỗi: " . $stmt->error;
        }


        $stmt->close();
    } else {
        echo "Mật khẩu và xác nhận mật khẩu không khớp.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng xuất</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <a href="index.php" class="btn btn-outline-success">Back to home</a>
</body>

</html>