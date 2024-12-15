<?php session_start();

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




$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Thêm CSS của Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Thêm JS của Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
        </div>
        <div class=" ms-3 col-4">
            <h1 class="text-white mb-4">Quản lý thông tin</h1>
            <div class="d-flex text-white mb-4 ">
                <p class="py-1 flex-fill">
                    <button class="btn text-white" data-bs-toggle="collapse" data-bs-target="#infoCollapse"
                        aria-expanded="false" aria-controls="infoCollapse">
                        Thông tin cá nhân
                    </button>
                </p>

                <p class="py-1 flex-fill">
                    <button class="btn text-white" data-bs-toggle="collapse" data-bs-target="#securityCollapse"
                        aria-expanded="false" aria-controls="securityCollapse">
                        Tài khoản và bảo mật
                    </button>
                </p>
                <p class="py-1 flex-fill">
                    <button class="btn text-white" data-bs-toggle="collapse" data-bs-target="#linkCollapse"
                        aria-expanded="false" aria-controls="linkCollapse">
                        Tài khoản liên kết
                    </button>
                </p>
            </div>
            <!-- Info collapse  -->
            <div class="collapse" id="infoCollapse">
                <div class="px-3 py-2 mb-4 rounded text-white bg-dark">
                    Tên đăng nhập
                    <div><b>
                            <?php if (isset($_SESSION['username'])): ?>
                                <span class="navbar-text text-white ">
                                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                                </span>
                            <?php else: ?>
                            <?php endif; ?>

                        </b>
                    </div>
                </div>
                <div class="px-3 py-2 mb-4 rounded text-white bg-dark">
                    ID người dùng
                    <div><b>
                            <?php if (isset($_SESSION['username'])): ?>
                                <span class="navbar-text text-white ">
                                    <?php echo htmlspecialchars($_SESSION['users_id']); ?>
                                </span>
                            <?php else: ?>
                            <?php endif; ?>
                        </b></div>
                </div>
                <!-- form -->
                <form action="update_profile.php" method="POST" class="w-full">
                    <div class="form-floating text-white py-2 mb-4">
                        <input type="text" class="form-control bg-dark text-white" id="fullname_input" name="fullname"
                            value="<?php echo isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname']) : ''; ?>">
                        <label for="fullname_input">Họ và tên</label>
                    </div>
                    <div class="row gap-3 px-3">
                        <div class="py-2 rounded text-white bg-dark col">
                            Ngày sinh
                            <div>
                                <b>
                                    <?php if (isset($_SESSION['username'])): ?>
                                        <input type="date" class="form-control bg-dark text-white" id="dateofbirth-input"
                                            name="dateofbirth"
                                            value="<?php echo isset($_SESSION['dateofbirth']) ? htmlspecialchars($_SESSION['dateofbirth']) : ''; ?>">
                                    <?php else: ?>
                                    <?php endif; ?>
                                </b>
                            </div>
                        </div>
                        <div class="dropdown text-white bg-dark col rounded">
                            <button class="btn btn-dark dropdown-toggle" type="" id="dropdownButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Giới tính
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="updateDropdown('Nam')">Nam</a></li>
                                <li><a class="dropdown-item" href="#" onclick="updateDropdown('Nữ')">Nữ</a></li>
                                <li><a class="dropdown-item" href="#" onclick="updateDropdown('Khác')">Khác</a></li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="genderInput" name="gender" value="">
                    <button type="submit" class="btn btn-success mt-3">Cập nhật</button>
                    <button type="reset" class="btn btn-danger mt-3" onclick="resetForm()">Hủy</button>
                </form>
                <!-- end form  -->
            </div>
            <!-- end info -->

            <!-- security -->
            <div class="collapse" id="securityCollapse">
                <div class="px-3 py-2 mb-4 rounded text-white bg-dark">
                    Mật khẩu
                    <div><b>*********</b></div>
                </div>
                <div class="px-3 py-2 mb-4 rounded text-white bg-dark">
                    Email
                    <div><b><?php echo htmlspecialchars($_SESSION['email']); ?></b></div>
                </div>
                <form action="delete_account.php" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản?');">
                    <button type="submit" class="btn btn-danger mt-3">Xóa tài khoản</button>
                </form>
            </div>
            <!-- end security -->

            <!-- link account -->
            <div class="collapse text-white col-5" id="linkCollapse">
                <div class="d-flex justify-content-between ">
                    <div class="d-flex">
                        <a href="#" class="nav-link"><i class="bi bi-google"></i></a>
                        <p class="mx-3">Google</p>
                    </div>
                    <button class="btn btn-success ">Kết nối</button>
                </div>
                <div class="px-3 py-2 border-bottom opacity-25"></div>
                <div class="d-flex justify-content-between  py-2">
                    <div class="d-flex">

                        <a href="#" class="nav-link"><i class="bi bi-facebook"></i></a>
                        <p class="mx-3">Facebook</p>
                    </div>
                    <button class="btn btn-success">Kết nối</button>
                </div>
            </div>
            <!-- end link account -->

        </div>
    </div>
    <!-- end main content -->

    <!-- /////////////////////////////////////////////////////////////////////////////// -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>