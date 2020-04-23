<?php
	include "belakang/connect.php";
    if(!empty($_SESSION['user'])||isset($_SESSION['tingkat'])=="ADMIN"){header("location:admin/");}
   	else if(!empty($_SESSION['user'])||isset($_SESSION['tingkat'])=="ADMIN"){header("location:anggota/");}
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
						<a href="index.php"><li>Beranda</li></a>
						<a href="aturan.php" class="active"><li>Aturan</li></a>
						<a href="login.php"><li>Login</li></a>
						<a href="about.php"><li>About</li></a>
					</ul>
				</div>
			</div>
		</header>
		<div class="welcome">
			<div class="welcome-teks is-paused js-fade" id="welcome-teks">
				<center><h1>ATURAN <b>TRANSAKSI</b><br/>&darr;</h1>	</center>
				
			</div>
		</div>
		<section class="timeline">
		  <ul style="margin-top:0px;padding-left:0px;">
			<li>
			  <div>
				<h2>1</h2>
				<img src="img/1_1.png">
				 Sebelum mengajukan barang, <i>pengaju</i> harus terlebih dahulu menjadi anggota dari Koperasi Mawaddah. 
				 Belum menjadi anggota ? Daftarkan dirimu dengan mengisi <a style="text-decoration:underline;font-weight:bold;cursor:pointer;color:white;" href="#">formulir</a> berikut.
				 
			  </div>
			</li>
			<li>
			  <div>
				<h2>2</h2>
				<img src="img/1_2.png">
				 Setelah menjadi anggota dari Koperasi Truna. Lakukan proses login terlebih dahulu. Gunakan NIK dan Password masing-masing ya.
			  </div>
			</li> 
			<li>
			  <div>
				<h2>3</h2>
				Abis itu tunggu sampe petugas mengkonfirmasi bahwa barang sudah dibeli
			  </div>
			</li>
			<li>
			  <div>
				<h2>4</h2>
				Setelah barang ada di koperasi, anggota bisa datang ke koperasi untuk mengambil sekalian ngasih DP (kalau ada)
			  </div>
			</li>
			<!-- more list items here -->
		  </ul>
		</section> 
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
	<script>
	function isElementInViewport(el) {
	  var rect = el.getBoundingClientRect();
	  return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
		rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	  );
	}
	</script>
 </html>