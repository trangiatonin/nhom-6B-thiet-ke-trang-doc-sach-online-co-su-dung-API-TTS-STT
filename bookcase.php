<?php
session_start();



// Kết nối với cơ sở dữ liệu users_db
$servername = "localhost";
$username = "root";
$password = "";
$db_users_db = "users_db";
$db_book_storage = "book_storage";

// Kết nối tới users_db
$conn_users = new mysqli($servername, $username, $password, $db_users_db);
if ($conn_users->connect_error) {
    die("Kết nối tới users_db thất bại: " . $conn_users->connect_error);
}

$conn_books = new mysqli($servername, $username, $password, $db_book_storage);
if ($conn_users->connect_error) {
    die("Kết nối tới users_db thất bại: " . $conn_users->connect_error);
}

// Lấy danh sách book_id từ session (nếu có)
$clicked_books = isset($_SESSION['clicked_books']) ? $_SESSION['clicked_books'] : [];

if (count($clicked_books) > 0) {
    // Truy vấn các sách đã click từ cơ sở dữ liệu
    $book_ids = implode(',', $clicked_books);
    $sql = "SELECT * FROM ebook WHERE book_id IN ($book_ids)";
    $result = $conn_books->query($sql);
}


// Đóng kết nối tới users_db
$conn_users->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
</head>

<body class="bg-black">

    <!-- nav -->
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
                        <a class="nav-link link-light link-underline-opacity-0" href="">Sách điện
                            tử</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link link-light link-underline-opacity-0 " href="#">Sách nói</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link link-light link-underline-opacity-0 " href="#">Sách giấy</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link link-light link-underline-opacity-0 " href="#">Fanpage</a>
                    </li>
                </ul>

                <form class="d-flex form" action="search.php" method="GET">
                    <input class="form-control border-input" type="search" placeholder="Search" aria-label="Search"
                        name="search" id="searchInput">
                    <button class="btn btn-outline-success search-icon" type="submit">
                        <i class="bi bi-search text-white"></i>
                    </button>
                    <button type="button" class="microphone btn btn-outline-success text-white"
                        onclick="startVoiceRecognition()"><i class="bi bi-mic-fill"></i></button>
                </form>
                <div class="d-flex gap-3">
                    <!-- hello user -->
                    <?php if (isset($_SESSION['username'])): ?>
                        <a class="navbar-text text-white btn btn-outline-success" href="profile.php">
                            Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <a href="logout.php" class="btn btn-outline-light">Đăng xuất</a>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- end nav -->

    <!-- main content -->
    <div class="d-flex" style="margin-left: 37px;">
        <div class="p-3  col-3">
            <div class="d-flex  justify-content-between">
                <div><?php if (isset($_SESSION['username'])): ?>
                        <span class="navbar-text text-white ">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
                <img src="https://307a0e78.vws.vegacdn.vn/view/v2/image/img.avatar/0/0/35/18313/9376576.jpg?v=11&w=200&h=200/"
                    alt="" class="rounded-4" style="width: 48px; height: 48px">
            </div>
            <div class="mt-5">
                <a href="profile.php" class="nav-link">
                    <p class="text-white "><i class="bi bi-person mx-5"></i>Quản lý tài khoản</p>
                </a>
                <a href="bookcase.php" class="nav-link">
                    <p class="text-white "><i class="bi bi-book mx-5"></i>Tủ sách cá nhân</p>
                </a>
                <p class="text-white" id="customer-service" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#customerModal">
                    <i class="bi bi-headset mx-5"></i> Chăm sóc khách hàng
                </p>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content bg-black">
                    <div class="modal-header d-flex justify-content-between">
                        <div class="text-center w-100">
                            <h5 class="modal-title text-white" id="customerModalLabel">Bạn cần hỗ trợ?</h5>
                            <h6 class="text-white">Liên hệ với chúng tôi thông qua các kênh hỗ trợ</h6>
                        </div>
                        <div class="bg-white"><button type="button" class="btn-close m-1" data-bs-dismiss="modal"
                                aria-label="Close"></button></div>
                    </div>
                    <div class="modal-body ">
                        <div class="d-flex gap-3 justify-content-between py-2 px-3">
                            <button type="button" class="btn py-2 px-3 rounded-pill btn-dark text-white w-100"><i
                                    class="bi bi-messenger me-2"></i>Messenger</button>
                            <button type="button" class="btn py-2 px-3 rounded-pill btn-dark text-white w-100"><i
                                    class="bi bi-instagram me-2"></i>Instagram</button>
                        </div>
                        <p class="text-white text-center">Hoặc</p>

                        <div class="mb-2 px-3"><button type="button"
                                class="btn py-2 px-3 rounded-pill btn-dark text-white text w-100"><i
                                    class="bi bi-telephone-fill me-2" data-bs-toggle="button"></i>Hotline:
                                0123456789</button></div>
                        <div class="mb-2 px-3"><button type="button"
                                class="btn py-2 px-3 rounded-pill btn-dark text-white text w-100"><i
                                    class="bi bi-headset me-2"></i>Tổng đài: 123456789 nháy phím 1</button></div>
                        <div class="mb-2 px-3"><button type="button"
                                class="btn py-2 px-3 rounded-pill btn-dark text-white text w-100"><i
                                    class="bi bi-envelope-fill me-2"></i>Email: support@web.vn</button></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <div class="p-3 ms-3 col-7 text-white">

            <div class="d-flex">
                <div class="flex-fill">
                    <p> Sách Đang nghe</p>
                </div>

            </div>


            <div class="row gap-3">
                <?php if (count($clicked_books) > 0 && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>



                        <div class="card bg-dark text-white h-100 col-2 ">
                            <a href="ebook.php?book_id=<?php echo $row['book_id']; ?>" class="text-decoration-none">
                                <img class="img-fluid rounded-4 img-size w-100"
                                    src="<?php echo htmlspecialchars($row['book_img']); ?>"
                                    alt="<?php echo htmlspecialchars($row['book_title']); ?>">
                            </a>

                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['book_title']); ?></h5>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Không có sách nào trong tủ sách của bạn.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <!-- end main content -->




    <script src="js/script.js"></script>
</body>

</html>