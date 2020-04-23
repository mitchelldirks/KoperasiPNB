<?php
	// include "../belakang/connect.php";
    // if(!empty($_SESSION['user'])||isset($_SESSION['tingkat'])){header("location:main.php");}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include 'link/head.php'; ?>

  </head>
  <body class="cek">
	<div>
		<button onclick="topFunction()" id="topBtn" title="Go to top">^</button>
		<header>
			<div class="nav-bar-container">
				<div class="logo">
					<img src="img/koperasi.png" width="30px">
							<span class="m2" style="color: #00913F">Patogu Nuansa Baru</span><span class="m2" style="color:#CFEA7F"> Bekasi</span>
					
				</div>
				<div class="menu-bar">
					<ul class="nav-bar">
						<a href="#" class="active"><li>Beranda</li></a>
						<a href="aturan.php"><li>Aturan</li></a>
						<a href="login.php"><li>Login</li></a>
						<a href="about.php"><li>About</li></a>
					</ul>
				</div>
			</div>
		</header>
		<div class="welcome">
			<div class="welcome-teks is-paused js-fade" id="welcome-teks">
				<h1>KOPERASI JUAL BELI <b>KOMERSIL</b> PALING HITS !</h1>
				<p style="font-size:18px; letter-spacing:3px;">Patogu Nuansa Baru hadir untuk mensejahterakan orang atas <i>Indonesia</i>. </br> Sebuah koperasi komersil yang berprofit !</p>
			</div>
		</div>
		<div class="intro">
			<div class="intro_container">
				<div class="intro_text">
					<h2>APA ITU KOPERASI PNB ?</h2>
					<i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</i>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
				<div class="intro_pict">
					<img src="img/logo2.png" width="275px">
				</div>
			</div>
		</div>
		<div class="fitur">
			<div class="fitur_container">
				<div class="fitur_text">
					<h2>BAGAIMANA CARA KERJA KOPERASI ?</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<a href="aturan"><button><b>Pelajari Selengkapnya</b></button></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="layanan">
			<div class="layanan_container">
				<div class="layanan_text">
					<h2>FITUR FITUR KAMI</h2>
					<i>Terdapat 4 buah fitur utama yang kami unggulkan, diantaranya adalah</i>
				</div>
				<div class="bungkus_det">
					<div class="layanan_det">
						<div class="det_pic">
							<img src="img/upload.svg" width="80%">
						</div>
						<h4>PENGAJUAN</h4>
						<p>Anggota koperasi dapat mengajukan barang yang nantinya akan dibelikan oleh koperasi. Tentunya, kami tetap mengedepankan transaksi komersil.</p>
					</div>
					<div class="layanan_det">
						<div class="det_pic">
							<img src="img/shield-alt.svg" width="80%">
						</div>
						<h4>TRANSPARANSI</h4>
						<p>Karena kami merupakan koperasi komersil. Maka segala hal terkait dengan transaksi jual beli barang,  akan kami tutup-tutupi.</p>
					</div>
					<div class="layanan_det">
						<div class="det_pic">
							<img src="img/chart-bar.svg" width="80%">
						</div>
						<h4>ANGSURAN</h4>
						<p>Angsuran bukan sembarang angsuran. Angsuran pada koperasi ini akan menyesuaikan diri dengan kemampuan finansial setiap anggotanya.</p>
					</div>
					<div class="layanan_det">
						<div class="det_pic">
							<img src="img/clipboard.svg" width="80%">
						</div>
						<h4>ANGSURAN</h4>
						<p>Angsuran bukan sembarang angsuran. Angsuran pada koperasi ini akan menyesuaikan diri dengan kemampuan finansial setiap anggotanya.</p>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="invite">
			<div class="invite-text">
				<h2>TERTARIK JADI ANGGOTA ?</h2>
				<p>Kepada yang berminat untuk bergabung bersama Koperasi Patogu Nuansa Baru silahkan mendaftar pada formulir  terlebih dahulu
				<!-- <br/>Harap membaca syarat menjadi anggota di file yang akan didownload -->
			</p>
				<a href="regis-biodata.php">
					<button><img src="img/user-plus.svg" class="menu-icon">Daftar Sekarang</button>
				</a>
			</div>
		</div>
		<div class="fact">
			<h2 style="font-weight:700;"><?=strtoupper("FUN FACT MENGENAI Patogu Nuansa Baru")?></h2>
			<ul class="fact-point">
				<li><img src="img/users.svg" height="30px"><br/>
					<?php
						$query = mysqli_query($con,"SELECT * FROM tbl_user WHERE hak_akses = 'ANGGOTA'");

						$num = mysqli_num_rows($query);
						echo"
						<h1>$num</h1>
						<p>Jumlah Anggota</p>";
					?>
				</li>
				<li><img src="img/file-alt.svg" height="30px"><br/>
					<?php
						$query = mysqli_query($con,"SELECT * FROM tbl_transaksi");

						$num = mysqli_num_rows($query);
						echo"
						<h1>$num</h1>
						<p>Jumlah Transaksi</p>";
					?>
				<li><img src="img/upload.svg" height="30px"><br/>
					<?php
						$query = mysqli_query($con,"SELECT * FROM tbl_pengajuan");

						$num = mysqli_num_rows($query);
						echo"
						<h1>$num</h1>
						<p>Jumlah Pengajuan</p>";
					?>
				</li>
				<li><img src="img/file-alt.svg" height="30px"><br/>
					<h1><?php
						$query = mysqli_query($con,"SELECT * FROM tbl_transaksi");

						$num = mysqli_num_rows($query);
						echo"
						<h1>$num</h1>";
					?></h1>
					<p>Jumlah Transaksi</p></li>
			</ul>
			<div class="clear"></div>
		</div>
		<footer>
		<ul class="nav-bar">
						<a href="#" class="active2"><li>Beranda</li></a>
						<a href="aturan"><li>Aturan</li></a>
						<a href="login"><li>Login</li></a>
						<a href="about"><li>About</li></a>
					</ul>
			<p>Copyright &copy; Crafted by <b>Farhan and Gibran.</b></p>
		</footer>
	</div>
  </body>
  	<script>
		var el = document.querySelector('.js-fade');
		if (el.classList.contains('is-paused')){
		  el.classList.remove('is-paused');
		}
	</script>
	<script>
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				var el = document.getElementById('topBtn');
				if (el.classList.contains('is-paused')){
				  el.classList.remove('is-paused');
				}
				document.getElementById("topBtn").style.display = "block";
				
			} else {
				document.getElementById("topBtn").style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>
 </html>