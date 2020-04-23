<?php
	session_destroy();
	session_start();
	// include "../belakang/connect.php";
	if (isset($_POST['submit'])) {
			$un = $_POST['username'];
			$pw = $_POST['password'];
			$md5 = md5($pw);
			$q = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$un' AND password = '$md5'");
			if($record = mysqli_fetch_array($q)){
				if($record['hak_akses'] == 'ADMIN'){
					$_SESSION['user']=$record['username'];
                    $_SESSION['tingkat']="ADMIN";
                    header("location:main.php");
				}else{
					$_SESSION['user']=$record['username'];
                    $_SESSION['tingkat']="ANGGOTA";
                    header("location:anggota");
				}
			}else{
				$q = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$un' AND password = '$pw'");
				
					if($record = mysqli_fetch_array($q)){
						if($record['hak_akses'] == 'ADMIN'){
							$_SESSION['user']=$record['username'];
		                    $_SESSION['tingkat']="ADMIN";
		                    header("location:main.php");
						}else{
							$_SESSION['user']=$record['username'];
		                    $_SESSION['tingkat']="ANGGOTA";
		                    header("location:anggota");
						}
					}else{
						if ($_POST['username']=='Admin' && $_POST['password']=='demo') {
							$_SESSION['user']="ADMIN";
							$_SESSION['tingkat']="ADMIN";
							header("location:main.php");
						}elseif ($_POST['username']=='Anggota' && $_POST['password']=='demo') {
							$_SESSION['user']="ANGGOTA";
							$_SESSION['tingkat']="ANGGOTA";
							header("location:main.php");
						}else{
						$_SESSION['gagal']=1;
						}
					}
			}
	}
    if($_SESSION['tingkat']=="ADMIN" || $_SESSION['tingkat']=="ANGGOTA"){header("location:main.php");}
?>
<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Patogu Nuansa Baru Bekasi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" sizes="32x32" href="img/koperasi.png">
	<!--  CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="css/style.css">
	
	<!--  JS -->
    <script src="public/js/main.js"></script>
    <script src="js/script.js"></script>
	
  </head>
  <body class="cek">
	<div>
		<header>
			<div class="nav-bar-container">
				<div class="logo">
					<img src="img/koperasi.png" width="30px">
							<span class="m2" style="color: #00913F">Patogu Nuansa Baru</span><span class="m2" style="color:#CFEA7F"> Bekasi</span>
					
				</div>
				<div class="menu-bar">
					<ul class="nav-bar">
						<a href="index.php"><li>Beranda</li></a>
						<a href="aturan.php"><li>Aturan</li></a>
						<a href="login.php" class="active"><li>Login</li></a>
						<a href="about.php"><li>About</li></a>
					</ul>
				</div>
			</div>
		</header>
		<div class="login">
			<div class="login-box">
				<div class="login-img">
					<?php if ($_SESSION['gagal']==1): ?>
						<div style="padding:8px; margin: 8px;background: #D50404;color: white; border: 0.5px solid #999;border-radius: 5px;">
						Login Gagal!<br>
						username atau password salah
					</div>
					<?php else : ?>
						<h3><span class="m2" style="color: #CFEA7F">Patogu Nuansa Baru</span><span class="m2" style="color:#CFEA7F"> Bekasi</span></h3>
					<?php endif ?>
					<img src="img/koperasi.png" width="150px">
					
				</div>
				<div class="form-login">
					<div class="bungkus-form">
						<br>
					<center>
					<!-- <form action="proses/login" method="POST"> -->
					<form method="POST">
						<div class="login-style">
							<img src="img/username-icon2.png" class="icon">
							<input type="text" name='username' id='UN' onchange='isOnlySpace(this)' placeholder="Username" required />
						</div>
						<div class="login-style">
							<img src="img/pass-icon.png" class="icon">
							<input type="password" name='password' id='pass' onchange='isOnlySpace(this)' placeholder="Password" required />
						</div>
						<input type="submit" name="submit" value="Login" class="login-button"/><br/>
					</form>
						<small style="color: white">Belum punya akun? <a href="" style="color: #CFEA7F;text-decoration: underline;">daftar disini</a></small>
					</center>

					</div>

				</div>
			</div>
		</div>
		<footer class="foot_login">
			<p>Copyright &copy; <?=date("Y")?> made by <b><a href="https://github.com/pottsed">Pottsed</a></b></p>
		</footer>
	</div>
  </body>
  
 </html>