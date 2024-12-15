<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_storage";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có từ khóa tìm kiếm
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    // Truy vấn tìm kiếm
    $stmt = $conn->prepare("SELECT * FROM ebook WHERE book_title LIKE ? ORDER BY book_id LIMIT 5");
    $likeSearch = "%$search%";
    $stmt->bind_param("s", $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();
}
// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Tìm kiếm</title>
</head>

<body class="bg-black">
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
                    <li class="nav-item  ">
                        <a class=" nav-link link-light link-underline-opacity-0" href="">Sách điện
                            tử</a>
                    </li>
                    <li class="nav-item ">
                        <a class=" nav-link link-light link-underline-opacity-0 " href="#">Sách nói</a>
                    </li>
                    <li class="nav-item ">
                        <a class=" nav-link link-light link-underline-opacity-0 " href="#">Sách giấy</a>
                    </li>
                    <li class="nav-item ">
                        <a class=" nav-link link-light link-underline-opacity-0 " href="#">Fanpage</a>
                    </li>
                </ul>
                <div class="d-flex gap-3">
                    <?php if (isset($_SESSION['username'])): ?>
                        <span class="navbar-text text-white btn btn-outline-danger">
                            Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?><i
                                class="mx-1 bi bi-caret-down-fill text-white"></i>
                        </span>
                        <a href="logout.php" class="btn btn-outline-danger">Đăng xuất</a>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- end nav -->

    <!-- main content -->

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="text-white mt-5">
                <h1 class="ms-5">Kết quả tìm kiếm cho: <?php echo htmlspecialchars($row['book_title']); ?></h1>
            </div>
            <div class="mb-3 d-flex gap-3  mt-3 " style="margin-left: 48px;">
                <div class="card bg-dark text-white h-100 col-2">
                    <a href="ebook.php?book_id=<?php echo $row['book_id']; ?>" class="text-decoration-none">
                        <img class="img-fluid rounded-4 img-size w-100" src="<?php echo htmlspecialchars($row['book_img']); ?>"
                            alt="<?php echo htmlspecialchars($row['book_title']); ?>">
                    </a>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['book_title']); ?></h5>
                    </div>
                </div>
                <div class="col-6 text-white d-grid bg-dark">
                    <div>
                        <h1><?php echo htmlspecialchars($row['book_title']); ?></h1>
                        <div class="d-flex mb-4">
                            <i class="bi bi-star-fill" style="color: gold;"></i>
                            <i class="bi bi-star-fill" style="color: gold;"></i>
                            <i class="bi bi-star-fill" style="color: gold;"></i>
                            <i class="bi bi-star-fill" style="color: gold;"></i>
                            <i class="bi bi-star-fill" style="color: gold;"></i>
                            <p class="mx-3">- 10 Đánh giá</p>
                        </div>
                        <div class="d-flex flex-wrap">
                            <p class="col-6"><strong>Tác giả: </strong> <?php echo htmlspecialchars($row['book_author']); ?>
                            </p>
                            <p class="col-6"><strong>Thể loại: </strong> <?php echo htmlspecialchars($row['category']); ?>
                            </p class="col-6">
                            <p class="col-6"><strong>Nhà sản xuất: </strong>
                                <?php echo htmlspecialchars($row['publisher']); ?>
                            </p class="col-6">
                            <p class="col-6"><strong>Ngày đăng: </strong>
                                <?php echo htmlspecialchars($row['book_update']); ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <a class="col-4 btn btn-outline-success text-white"><i class="bi bi-book mx-1"></i>Đọc
                            sách</a>
                        <button class="col-4 btn btn-outline-success text-white"><i class="bi bi-play mx-1"></i>Nghe
                            sách</button>
                        <button class=" btn btn-secondary"><i class="bi bi-heart"></i></button>
                    </div>

                    <div>
                        <p><strong>Miêu tả: </strong>
                            <?php
                            $description = htmlspecialchars($row['description']);
                            echo strlen($description) > 100 ? substr($description, 0, 400) . '...' : $description;
                            ?>
                        </p>
                    </div>
                </div>

            </div>


        <?php endwhile; ?>

    <?php else: ?>
        <p class="text-white ms-5">Không có sách nào để hiển thị.</p>
    <?php endif; ?>
    <script src="js/bootstrap.js"></script>
</body>

</html>