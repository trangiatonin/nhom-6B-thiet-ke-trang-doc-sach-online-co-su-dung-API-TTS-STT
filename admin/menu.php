<?php
include('db.php');

// Lấy tất cả sách từ cơ sở dữ liệu
$sql = "SELECT * FROM ebook";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý sách</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <div class="container mt-5 text-white">
        <h1 class="text-center">Quản lý sách</h1>
        <table class="table table-bordered">
            <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="text-white">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['book_id']; ?></td>
                        <td><?php echo $row['book_title']; ?></td>
                        <td><?php echo $row['book_author']; ?></td>
                        <td><?php echo $row['price']; ?> VND</td>
                        <td>
                            <a href="edit_book.php?book_id=<?php echo $row['book_id']; ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete_book.php?book_id=<?php echo $row['book_id']; ?>" class="btn btn-danger">Xóa</a>
                            <a href="add_book.php" class="btn btn-primary">Thêm sách mới</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>