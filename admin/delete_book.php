<?php
include('db.php');

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Xóa sách từ cơ sở dữ liệu
    $sql = "DELETE FROM ebook WHERE book_id = $book_id";
    if ($conn->query($sql) === TRUE) {
        header('Location: menu.php');
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="menu.php" class="btn btn-outline-success">Menu</a>
</body>

</html>