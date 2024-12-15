<?php
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


if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']); // Bảo mật dữ liệu đầu vào

    // Truy vấn từ cơ sở dữ liệu book_storage
    $query = "SELECT * FROM ebook WHERE book_id = $book_id";
    $result = $conn_book_storage->query($query);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sách.";
        exit;
    }
} else {
    echo "ID sách không được cung cấp.";
    exit;
}
$conn_book_storage->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sách điện tử</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=antATAYv"></script>
</head>

<body class="bg-black ">

    <nav class="navbar navbar-expand-lg bg-dark-overlay w-100 ">
        <div class="container-fluid">
            <a href="index.php"><img class="img-fluid" style="margin-left: 37px" src="image/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class=" nav-link link-light link-underline-opacity-0" href="#">Sách điện
                            tử</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link link-light link-underline-opacity-0 " href="#">Sách nói</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link link-light link-underline-opacity-0 " href="#">Sách giấy</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link link-light link-underline-opacity-0 " href="#">Fanpage</a>
                    </li>
                </ul>
                <!-- user -->
                <div class="d-flex gap-3">
                    <!-- hello user -->
                    <?php if (isset($_SESSION['username'])): ?>
                        <a class="navbar-text text-white btn btn-outline-success" href="profile.php">
                            Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <a href="logout.php" class="btn btn-outline-light">Đăng xuất</a>
                    <?php else: ?>
                        <!-- hello user -->

                        <form class="d-flex form" action="search.php" method="GET">
                            <input class="form-control border-input" type="search" placeholder="Search" aria-label="Search"
                                name="search" id="searchInput">
                            <button class="btn btn-outline-success search-icon" type="submit">
                                <i class="bi bi-search text-white"></i>
                            </button>
                            <button type="button" class="microphone btn btn-outline-success text-white"
                                onclick="startVoiceRecognition()"><i class="bi bi-mic-fill"></i></button>
                        </form>
                    <?php endif; ?>
                </div>
                <!-- end user -->
            </div>
        </div>
    </nav>
    <div class="container d-flex text-white">
        <div class="col-4">
            <img class="img-fluid rounded-4" src="<?php echo htmlspecialchars($book['book_img']); ?>"
                alt="<?php echo htmlspecialchars($book['book_title']); ?>"
                style="max-height: 100%; width: 349px; object-fit: cover;">
        </div>

        <div class=" col-8 d-grid">
            <div>
                <h1><?php echo htmlspecialchars($book['book_title']); ?></h1>
                <div class="d-flex mb-4">
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <p class="mx-3">- 10 Đánh giá</p>
                </div>
                <div class="d-flex flex-wrap">
                    <p class="col-6"><strong>Tác giả: </strong> <?php echo htmlspecialchars($book['book_author']); ?>
                    </p>
                    <p class="col-6"><strong>Thể loại: </strong> <?php echo htmlspecialchars($book['category']); ?></p
                        class="col-6">
                    <p class="col-6"><strong>Nhà sản xuất: </strong> <?php echo htmlspecialchars($book['publisher']); ?>
                    </p class="col-6">
                    <p class="col-6"><strong>Ngày đăng: </strong> <?php echo htmlspecialchars($book['book_update']); ?>
                    </p>
                </div>
            </div>
            <div>
                <!-- content -->
                <div class="mt-3">
                    <p id="subtitle" class="mt-3 text-white" style="font-weight: bold; font-size: 1.2em; display:none">
                        <?php echo nl2br(string: htmlspecialchars($book['content'])); ?>
                    </p>
                </div>
                <!-- end-content -->

                <a class="col-4 btn btn-outline-success text-white"><i class="bi bi-book mx-1"></i>Đọc
                    sách</a>
                <button onclick="toggleReading()" class="col-4 btn btn-outline-success text-white"><i
                        class="bi bi-play mx-1"></i>Nghe
                    sách</button>
                <button class=" btn btn-secondary"><i class="bi bi-heart"></i></button>
                <button onclick="stopReading()" class="col-8 btn btn-outline-success text-white mx-1">
                    <i class=" bi bi-pause"></i> Dừng
                </button>
            </div>

            <div>
                <p><strong>Miêu tả: </strong>
                    <?php
                    $description = htmlspecialchars($book['description']);
                    echo strlen($description) > 100 ? substr($description, 0, 400) . '...' : $description;
                    ?>
                </p>
            </div>

        </div>
        <!-- Giả sử bạn có cột description trong bảng books -->
    </div>

    <script src="ja/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>