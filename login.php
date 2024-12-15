<?php
session_start(); // Bắt đầu session


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("SELECT email, gender, fullname, dateofbirth, users_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email, $gender, $fullname, $dateofbirth, $users_id, $stored_password);

    // Kiểm tra số lượng kết quả trả về
    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // So sánh mật khẩu đã nhập với mật khẩu lưu trữ
        if ($password === $stored_password) {
            echo "Đăng nhập thành công!";
            // Đăng nhập thành công, lưu tên người dùng vào session
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $users_id;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['dateofbirth'] = $dateofbirth;
            $_SESSION['gender'] = $gender;
            $_SESSION['email'] = $email;


            // Chuyển hướng về trang chủ
            header('Location: index.php');
            exit();
        } else {
            echo "Mật khẩu không chính xác!";
        }
    } else {
        echo "Tài khoản không tồn tại!";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <a href="index.php" class="btn btn-outline-success">Back to home</a>
</body>

</html>