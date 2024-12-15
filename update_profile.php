<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . $conn->connect_error);
}

// Kiểm tra dữ liệu từ form
if (isset($_POST['fullname'], $_POST['dateofbirth'], $_POST['gender'])) {
    $fullname = trim($_POST['fullname']);
    $dateofbirth = trim($_POST['dateofbirth']);
    $gender = trim($_POST['gender']);
    $username = $_SESSION['username']; // Lấy username từ session

    // Kiểm tra dữ liệu không trống
    if (!empty($fullname) && !empty($dateofbirth) && !empty($gender)) {
        // Cập nhật thông tin vào cơ sở dữ liệu
        $sql = "UPDATE users SET fullname = ?, dateofbirth = ?, gender = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $dateofbirth, $gender, $username);

        if ($stmt->execute()) {
            // Cập nhật lại session
            $_SESSION['fullname'] = $fullname;
            $_SESSION['dateofbirth'] = $dateofbirth;
            $_SESSION['gender'] = $gender;

            // Chuyển hướng với thông báo thành công
            header("Location: profile.php?success=Cập nhật thành công");
            exit();
        } else {
            $error = "Có lỗi xảy ra: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Vui lòng điền đầy đủ thông tin!";
    }
} else {
    $error = "Dữ liệu không hợp lệ!";
}

$conn->close();

// Hiển thị thông báo lỗi nếu có
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
    echo "<a href='profile.php'>Quay lại trang hồ sơ</a>";
}
?>