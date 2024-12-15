<?php
////////////////////////

session_start();
$servername = "localhost";
$username = "root";
$password = "";

// Kết nối với book_storage
$conn_book_storage = new mysqli($servername, $username, $password, "book_storage");

// Kiểm tra kết nối
if ($conn_book_storage->connect_error) {
    die("Kết nối với book_storage thất bại: " . $conn_book_storage->connect_error);
}

// Kiểm tra và lấy `book_id` từ GET
if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']); // Bảo mật dữ liệu đầu vào

    // Sử dụng prepared statements để bảo mật SQL Injection
    $stmt = $conn_book_storage->prepare("SELECT content FROM ebook WHERE book_id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();

        // Tạo mảng nội dung để truyền sang JavaScript
        $contentArray = explode("\n", $book['content']); // Giả định `content` là văn bản dài, tách theo dòng
    } else {
        echo "Không tìm thấy sách.";
        exit;
    }

    $stmt->close();
} else {
    echo "ID sách không được cung cấp.";
    exit;
}

// Chuyển dữ liệu thành JSON để sử dụng trong JavaScript
echo "<script>const contentData = " . json_encode($contentArray) . ";</script>";

// Đóng kết nối
$conn_book_storage->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginate Content</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .page {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border: 1px solid #ddd;
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div id="paginationContainer" class="container-fluid ">
        <p id="subtitle" class="mt-5 col-8" style="font-weight: bold; font-size: 1.2em;">
            <?php echo nl2br(string: htmlspecialchars($book['content'])); ?>
        </p>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>