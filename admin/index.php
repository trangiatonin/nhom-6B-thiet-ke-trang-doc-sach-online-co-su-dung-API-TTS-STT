<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$username = $_POST['username'];
	$password = $_POST['password'];

	// Chuẩn bị câu lệnh SQL
	$stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($stored_password);

	// Kiểm tra số lượng kết quả trả về
	if ($stmt->num_rows > 0) {
		$stmt->fetch();

		// So sánh mật khẩu đã nhập với mật khẩu lưu trữ
		if ($password === $stored_password) {
			echo "Đăng nhập thành công!";
			// Đăng nhập thành công, lưu tên người dùng vào session
			$_SESSION['username'] = $username;
			// Chuyển hướng về trang chủ
			header('Location: menu.php');
			exit();
		} else {
			echo "Mật khẩu không chính xác!";
		}
	} else {
		echo "Tài khoản không tồn tại!";
	}

	$stmt->close();
	$conn->close();
}
?>

<!doctype html>
<html>

<head>
	<title>Official Signup Form Flat Responsive widget Template :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords"
		content="Official Signup Form Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script
		type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
	<!-- /fonts -->
	<!-- css -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
	<!-- /css -->
</head>

<body>
	<h1 class="w3ls">Sign in for Admin</h1>
	<div class="content-w3ls">
		<div class="content-agile1">
			<h2 class="agileits1">Official</h2>
			<p class="agileits2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		</div>
		<div class="content-agile2">
			<form action="#" method="post">
				<div class="form-control w3layouts">
					<input type="text" id="firstname" name="username" placeholder="Username"
						title="Please enter your First Name" required="">
				</div>



				<div class="form-control agileinfo">
					<input type="password" class="lock" name="password" placeholder="Password" id="password1"
						required="">
				</div>



				<input type="submit" class="register" value="Login">
			</form>
			<script type="text/javascript">
				window.onload = function () {
					document.getElementById("password1").onchange = validatePassword;
					document.getElementById("password2").onchange = validatePassword;
				}
				function validatePassword() {
					var pass2 = document.getElementById("password2").value;
					var pass1 = document.getElementById("password1").value;
					if (pass1 != pass2)
						document.getElementById("password2").setCustomValidity("Passwords Don't Match");
					else
						document.getElementById("password2").setCustomValidity('');
					//empty string means no validation error
				}
			</script>
			<p class="wthree w3l">Fast Signup With Your Favourite Social Profile</p>
			<ul class="social-agileinfo wthree2">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<p class="copyright w3l">© 2017 Official Signup Form. All Rights Reserved | Design by <a
			href="https://w3layouts.com/" target="_blank">W3layouts</a></p>
</body>

</html>