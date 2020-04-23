<?php
	// include "belakang/connect.php";

    if(($_SESSION['user']==null)){
    	session_destroy();
    	header("location:login.php");
    }
    if (isset($_GET["logout"])) {
    	//session_destroy();
    	header("location: login.php");
    }
    if (isset($_GET['a'])) {
    	include 'belakang/kerja.php';    }

    if (isset($_SESSION['user'])) {

    $q = mysqli_query($con,"SELECT * FROM tbl_anggota WHERE nik = '$_SESSION[user]'");
    // $record = array();
    // if($fetch = mysqli_fetch_array()){
    // 	$record = $fetch;
    // }
    $record = mysqli_fetch_array($q);
    }else{
    	 $record['nama']='Demo';
    }
?>
<!DOCTYPE html>
<html>
  <head>
  	
    <?php include 'link/head.php'; ?>

	
  </head>
  <body class="cek">
	<div>
		<div class="header-dash">
				<div class="dash-logo">
					<center><!-- <img src="img/koperasi.png" width="150px"> -->
						<div style="padding: 4px;">
							<span style="color: #00913F">Patogu Nuansa Baru</span><span style="color:#CFEA7F"> Bekasi</span>
						</div>
					</center>
				</div>
				<div class="dash-bar" onclick="dropdown()">
					<img src="img/user_pict.svg" class="img">
					<?php
						$exp = explode(" ", $record['nama']);
						echo "$exp[0] ".$exp[sizeof($exp)-1];
					?>
				</div>
				<div id="dropdown" class="dropdown">
					<div class="dropdown-main">
						<div>HELLO !<i class="kecil"><br/>"<?php echo "$exp[0] ".$exp[sizeof($exp)-1]; ?>"</i></div>
						<div class="clear"></div>
					</div>
					<div class="dropdown-button">
						<ul class="menu-userbar">
							<!-- <li><a href="?page=security"><img src="img/key.svg" class="menu-icon">Ubah Password</a></li> -->
							<li><a href="?logout"><img src="img/logout.svg" class="menu-icon">Logout</a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
		</div>
		<div class="content-dash">
			<?php
				switch($_SESSION['tingkat']){
					case "ADMIN":		include "admin/sidebar.php";	break;
					case "ANGGOTA":		include "anggota/sidebar.php";	break;
					default:echo "---";break;
				}
			?>
			<footer class="foot_dash">
			<p>Copyright &copy; <?=date("Y")?> <a href="https://github.com/pottsed">Pottsed</a></p>
			</footer>
			<div class="clear"></div>
		</div>
	</div>
  </body>
 <script type="text/javascript">
 	$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
 </script>
<script>
	function dropdown() {
		document.getElementById("dropdown").classList.toggle("show");
	}
	window.onclick = function(event) {
	  if (!event.target.matches('.dash-bar')) {

		var dropdowns = document.getElementsByClassName("dropdown");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	} 
</script>
</html>