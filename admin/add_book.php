<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['book_title'];
    $author = $_POST['book_author'];
    $description = $_POST['description'];
    $image = $_POST['book_img'];
    $book_update = $_POST['book_update'];
    $content = $_POST['content'];
    $sql = "INSERT INTO ebook ( book_title, book_author,description, book_img , book_update, content) VALUES ( '$title', '$author','$description','$image', '$book_update','$content')";

    if ($conn->query($sql) === TRUE) {
        header('Location: menu.php');
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sách mới</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">

</head>

<body>
    <div class="container mt-5 text-white d-flex flex-column align-items-center">
        <h1 class="text-center">Thêm sách mới</h1>
        <form method="POST" class="w-50">

            <div class="form-group">
                <label for="book_title">Tên sách:</label>
                <input type="text" class="form-control" id="book_title" name="book_title" required>
            </div>
            <div class="form-group">
                <label for="book_author">Tác giả:</label>
                <input type="text" class="form-control" id="book_author" name="book_author" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="form-group">
                <label for="book_img">Ảnh:</label>
                <input type="text" class="form-control" id="book_img" name="book_img">
            </div>
            <div class="form-group">
                <label for="content">Nội dung:</label>
                <input type="text" class="form-control" id="content" name="content">
            </div>
            <div class="form-group">
                <label for="book_update">Ngày xuất bản:</label>
                <input type="date" class="form-control" id="book_update" name="book_update">
            </div>

            <button type="submit" class="btn btn-primary w-100">Thêm sách</button>
        </form>
        <a href="menu.php" class="w-50 btn btn-primary mt-3">Menu</a>

    </div>


</body>

</html>
<?php
$conn->close();

?>