<div class="side-dash">
	<ul class="menu-sidebar">
		<li class="header">MENU</li>
		<li><a href='?page=beranda'><img src="img/home.svg" class="menu-icon">Beranda</a></li>
		<li><a href='?page=pengajuan'><img src="img/upload.svg" class="menu-icon">Pengajuan</a></li>
		<li><a href='?page=log_pengajuan'><img src="img/clipboard.svg" class="menu-icon">Log Pengajuan</a></li>
		<li><a href='?page=angsuran'><img src="img/fax.svg" class="menu-icon">Angsuran</a></li>
		<li><a href='?page=dokumen'><img src="img/id-card.svg" class="menu-icon">Dokumen</a></li>
	</ul>
</div>

<?php
	// include "belakang/connect.php";
	// include "belakang/database.php";

	if (isset($_GET['page'])) {} else {$_GET['page']="beranda";}
	switch ($_GET['page']) {
		case 'pengajuan':		include "link/anggota/pengajuan.php";			break;
		case 'dokumen':		include "link/anggota/dokumen.php";			break;
		case 'beranda':			include "link/anggota/beranda.php";				break;
		case 'angsuran':		include "link/anggota/angsuran.php";			break;
		case 'security':		include "link/anggota/security.php";			break;
		case 'log_pengajuan': 	include "link/anggota/log-pengajuan.php"; 		break;
		case 'barang':			include "link/anggota/barang.php";				break;
		default:				include "link/notfound.php";					break;
	}
?>