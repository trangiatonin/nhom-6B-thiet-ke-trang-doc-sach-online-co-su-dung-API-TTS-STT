<?php
include('db.php');

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Lấy thông tin sách từ cơ sở dữ liệu
    $sql = "SELECT * FROM ebook WHERE book_id = $book_id";
    $result = $conn->query($sql);
    $book = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['book_title'];
    $author = $_POST['book_author'];
    $price = $_POST['price'];
    $book_img = $_POST['book_img'];
    $description = $_POST['description'];


    $sql = "UPDATE ebook SET book_title = '$title', book_author = '$author', price = '$price', book_img ='$book_img', description='$description' WHERE book_id = $book_id";
    if ($conn->query($sql) === TRUE) {
        header('Location: menu.php');
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sách</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <div class="container mt-5 text-white d-flex flex-column align-items-center">
        <h2>Chỉnh sửa sách</h2>
        <form method="POST" class="w-50">
            <div class="form-group">
                <label for="book_title">Tên sách:</label>
                <input type="text" class="form-control" id="book_title" name="book_title"
                    value="<?php echo $book['book_title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="book_author">Tác giả:</label>
                <input type="text" class="form-control" id="book_author" name="book_author"
                    value="<?php echo $book['book_author']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $book['price']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="<?php echo $book['description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="book_img">Ảnh:</label>
                <input type="text" class="form-control" id="book_img" name="book_img"
                    value="<?php echo $book['book_img']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Chỉnh sửa sách</button>
        </form>
        <a href="menu.php" class="btn btn-primary w-50 mt-3">Menu</a>
    </div>
</body>

</html>

<?php
$conn->close();
?>