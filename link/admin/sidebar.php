<div class="side-dash">
	<ul class="menu-sidebar">
		<li class="header">MENU</li>
		<li><a href='?page=beranda'><img src="img/home.svg" class="menu-icon">Beranda</a></li>
		<li><a href='?page=pengajuan'><img src="img/upload.svg" class="menu-icon">Pengajuan</a></li>
		<li><a href='?page=konfirmasi'><img src="img/clipboard.svg" class="menu-icon">Konfirmasi Barang</a></li>
		<li><a href='?page=angsuran'><img src="img/fax.svg" class="menu-icon">Angsuran</a></li>
		<li><a href='?page=data_user'><img src="img/users.svg" class="menu-icon">Data Anggota</a></li>
		<li><a href='?page=tambah_kategori'><img src="img/edit.svg" class="menu-icon">Tambah Kategori</a></li>
	</ul>
</div>

<?php
	// include "belakang/connect.php";
	// include "belakang/database.php";
		// @$_GET['page'] = "beranda";
	if (isset($_GET['page'])) {} else {$_GET['page']="beranda";}
	switch ($_GET['page']) {
		case 'pengajuan':			include "link/admin/pengajuan.php";					break;
		case 'angsuran':			include "link/admin/angsuran.php";					break;
		case 'detail_angsuran': 	include "link/admin/detail-angsuran.php"; 			break;
		case 'security':			include "link/admin/security.php";					break;
		case 'beranda':				include "link/admin/beranda.php";					break;
		case 'konfirmasi':			include "link/admin/konfirmasi.php";				break;
		case 'detail_konfirmasi': 	include "link/admin/detail-konfirmasi.php"; 		break;
		case 'data_user': 			include "link/admin/data-user.php"; 				break;
		case 'tambah_anggota': 		include "link/admin/tambah-user.php"; 				break;
		case 'tambah_pekerjaan': 	include "link/admin/tambah-pekerjaan.php"; 			break;
		case 'tambah_kategori': 	include "link/admin/tambah-kategori.php"; 			break;
		case 'bayar_dp': 			include "link/admin/bayar-dp.php"; 					break;
		default:					include "link/notfound.php";						break;
	}
?>