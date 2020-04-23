<?php
	//include "connect.php";
	// if (isset($_GET['p'])) {
	// 	include "bekalang/database.php";
	// }else{
	// 	include "database.php";
	// }
	$page=$_GET['page'];
	// if (isset($_GET['id'])) {
	// 	$return=header('location: ?page='.$page.'&id='.$_GET['id']);
	// }elseif (isset($_POST['id'])) {
	// 	$return=header('location: ?page='.$page.'&id='.$_POST['id']);
	// }else{
	// 	$return=header('location: ?page='.$page);
	// } 

	function addId($id, $char){
		$len = strlen($id);
		$id = substr($id, 1);
		$id = $id+1;
		$len_id = strlen($id);

		for($i = 1;$i < ($len-$len_id);$i++){
			$id = '0'.$id;
		}
		$str = $char.$id;
		return $str;
	}

	switch ($_GET['a']) {
		case 'i_pengajuan':
			$nama = $_POST['Nama'];
			$kategori = $_POST['kategori'];
			$harga = $_POST['harga'];
			$untuk = $_POST['Peruntukan'];
			$spec = $_POST['Spesifikasi'];
			$asal = $_FILES['barang']['tmp_name'];
			$gambar = $_FILES['barang']['name'];
			$angsur = $_POST['besar_angsur'];

			$tujuan = "img/barang/".$gambar;

			copy($asal,$tujuan);
			$harga = str_replace(".", "", $harga);
			
			$q = mysqli_query($con,"SELECT * FROM tbl_barang ORDER BY id_barang DESC LIMIT 1");
			while($record = mysqli_fetch_array($q)){
				$id = $record['id_barang'];
			}

			$id = addId($id, 'B');
			//echo "$id";
			$id++;
			$spec = nl2br($spec);
			$untuk = nl2br($untuk);

			// $field = array("id_barang","nama","kategori","perkiraan_harga","gambar","spesifikasi");
   //          $isi = array($id,$nama,$kategori,$harga,$gambar,$spec);
   //          insert($field,$isi,"tbl_barang",$mysqli);
            mysqli_query($con,'INSERT INTO tbl_barang ("id_barang","nama","kategori","perkiraan_harga","gambar","spesifikasi") values ("$id","$nama","$kategori","$harga","$gambar","$spec") ');
            // $field = array("pengaju","barang","peruntukan","status","jml_angsur");
            // $isi = array($_SESSION['user'],$id,$untuk,0,$angsur);
            // insert($field,$isi,"tbl_pengajuan",$mysqli);
            mysqli_query($con,'INSERT INTO tbl_pengajuan ("pengaju","barang","peruntukan","status","jml_angsur") values ("'.$_SESSION['user'].'","$id","$untuk",0,"$angsur") ');

            $_SESSION['notif'] = 1;
            // header("location:../admin/pengajuan");
            header('location: ?page='.$page);
		break;
		case "p_login":
			$un = $_POST['username'];
			$pw = $_POST['password'];

			$pw = md5($pw);

			$q = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$un' AND password = '$pw'");
			if($record = mysqli_fetch_array($query)){
				if($record['hak_akses'] == 'ADMIN'){
					$_SESSION['user']=$record['username'];
                    $_SESSION['tingkat']="ADMIN";
                    header("location:../admin/");
				}else{
					$_SESSION['user']=$record['username'];
                    $_SESSION['tingkat']="ANGGOTA";
                    header("location:../anggota/");
				}
			}else{
				header("location:../login");
			}
		break;
		case "p_logout":
			session_destroy();
			header("location:../");
		break;
		case "p_changePassword":
			$old = $_POST['oldPassword'];
			$new = $_POST['newPassword'];

			$old = md5($old);
			$new = md5($new);
			echo "$old, $new, $_SESSION[user]";
			$query = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$_SESSION[user]' AND password='$old'");
			if(mysqli_num_rows($query)>0){
				$record = mysqli_fetch_array($query);
				$field = array("password");
	            $isi = array($new);
	            update($field,$isi,"tbl_user",$_SESSION['user'],"username",$mysqli);
	            $_SESSION['valid'] = 1;
				// header("location:../admin/security");
				header('location: ?page='.$page);
			}else{
				$_SESSION['valid'] = 0;
				// header("location:../admin/security");
				header('location: ?page='.$page);
			}
		break;
		case 'p_accPengajuan':
			$field = array("status");
            $isi = array(1);
            // update($field,$isi,"tbl_pengajuan",$_GET['id'],"id_pengajuan",$mysqli);
            $sql="UPDATE tbl_pengajuan SET status='1' where id_pengajuan='".$_GET['id']."'";
            mysqli_query($con,$sql);
            echo $sql;
            $_SESSION['valid'] = 1;
            $_SESSION['notif'] = 1;
            // header("location:../../admin/pengajuan");
            header('location: ?page='.$page);
		break;
		case 'p_accPenjualan':
			$field = array("status");
            $isi = array(6);
            update($field,$isi,"tbl_pengajuan",$_GET['id'],"id_pengajuan",$mysqli);
            $_SESSION['valid'] = 1;

            $_SESSION['notif'] = 1;
            // header("location:../../admin/pengajuan");
            header('location: ?page='.$page);
		break;
		case 'p_decPengajuan':
			$field = array("status");
            $isi = array(2);
            // update($field,$isi,"tbl_pengajuan",$_GET['id'],"id_pengajuan",$mysqli);

            mysqli_query($con,"UPDATE tbl_pengajuan SET status='2' where id_pengajuan='".$_GET['id']."'");
            $_SESSION['valid'] = 0;
            // header("location:../../admin/pengajuan");
            header('location: ?page='.$page);
		break;
		case 'p_konfirmasi':
			$id 		= $_POST['id'];
			$jml_angsur = $_POST['angsuran'];
			$harga 		= $_POST['realPrice'];

			$harga = str_replace(".", "", $harga);
			$today = date("d m Y", strtotime("now"));

			$field = array("status");
            $isi = array(3);
            update($field,$isi,"tbl_pengajuan",$id,"id_pengajuan",$mysqli);
            // bunga 5% untuk setiap angsurannya
            // echo (((0.83*$jml_angsur)+100)/100)*$harga;
            $angs=$harga/$jml_angsur;
            $bunga=($angs*5/100);
            $angs=$angs+$bunga;
            $jml=$angs*$jml_angsur;
            echo "Harga: ".$harga;
            echo "Bulanan: ".$jml;
            $field = array("pengajuan","harga_asli","banyak_angsuran","status");
            $isi = array($id,$harga,$jml_angsur,0);
            insert($field,$isi,"tbl_transaksi",$mysqli);


            // $field = array("harga_tambahan","tgl_awal","tgl_lunas");
            // $isi = array($id,$harga,$jml_angsur,0);
            // insert($field,$isi,"tbl_transaksi",$mysqli);

            $_SESSION['notif'] = 1;
            
            // header('location: ?page='.$page);

		break;
		case 'p_mengangsur':
			$bayar = $_POST['angsuran'];
			$id = $_POST['id'];

			$bayar = str_replace(".", "", $bayar);
			$field = array("id_angsuran","besar_angsuran");
            $isi = array($id,$bayar);
            // insert($field,$isi,"tbl_detail_angsuran",$mysqli);
            mysqli_query($con,"INSERT INTO tbl_detail_angsuran (id_angsuran,besar_angsuran) values ('$id','$bayar')");

            $query = mysqli_query($con,"SELECT a.id_transaksi,a.dp, (a.harga_tambahan - SUM(d.besar_angsuran)) sisa 
							FROM tbl_detail_angsuran d 
							INNER JOIN tbl_angsuran a ON(d.id_angsuran = a.id_angsuran) 
							WHERE d.id_angsuran = '$id' GROUP BY d.id_angsuran");

            if($record = mysqli_fetch_array($query)){
            	$sisa = $record['sisa'] - $record['dp'];
            	$id_transaksi = $record['id_transaksi'];
            }

            if($sisa <= 0){
            	$field = array("status");
            	$isi = array(1);
            	update($field,$isi,"tbl_transaksi",$id_transaksi,"id_transaksi",$mysqli);

            	$query = mysqli_query($con,"SELECT * FROM tbl_transaksi WHERE id_transaksi = '$id_transaksi'");

		        if($record = mysqli_fetch_array($query)){
		        	$id_pengajuan = $record['id_pengajuan'];
		        }
            	$field = array("status");
	            $isi = array(4);
	            update($field,$isi,"tbl_pengajuan",$id_pengajuan,"id_pengajuan",$mysqli);
            }
            
            $_SESSION['notif'] = 1;
            header("location:?page=detail_angsuran&id=$id");
		break;
		case 'i_anggota':
			$nik = $_POST['nik'];
			$nama = $_POST['Nama'];
			$pekerjaan = $_POST['pekerjaan'];
			$gaji = $_POST['gaji'];
			$persen = $_POST['persen'];
			$alamat = $_POST['alamat'];

			$gaji = str_replace(".", "", $gaji);

			$field = array("nik,nama,pekerjaan,alamat,gaji_perbulan,persentasi");
			$isi = array($nik,$nama,$pekerjaan,$alamat,$gaji,$persen);
			insert($field,$isi,"tbl_anggota",$mysqli);

			$_SESSION['notif'] = 1;
			// header("location:../admin/data_user");
			header('location: ?page='.$page);
		break;
		case 'i_DP':
			$dp = $_POST['dp'];
			$id = $_POST['id'];

			$dp = str_replace(".", "", $dp);

			//$field = array("dp");
			//$isi = array($dp);
			//update($field,$isi,"tbl_angsuran",$id,"id_transaksi",$mysqli);
			mysqli_query($con,"UPDATE tbl_angsuran set dp = $dp where id_angsuran=$id");

			$_SESSION['notif'] = 2;
			header("location:?page=detail_angsuran&id=$id");
		break;
		case 'i_pekerjaan':
			$pekerjaan = $_POST['pekerjaan'];
			$id = $_POST['id'];

			$field = array("id_pekerjaan","nama_pekerjaan");
			$isi = array($id,$pekerjaan);
			//echo "$id,$pekerjaan";
			insert($field,$isi,"tbl_pekerjaan",$mysqli);

			$_SESSION['notif'] = 1;
			// header("location:../admin/tambah_pekerjaan");
			header('location: ?page='.$page);
		break;
		case 'i_kategori':
			$kat = $_POST['kat'];
			$id = $_POST['id'];

			$field = array("id_kategori","kategori_barang");
			$isi = array($id,$kat);
			//echo "$id,$pekerjaan";
			insert($field,$isi,"tbl_kategori_barang",$mysqli);

			$_SESSION['notif'] = 1;
			// header("location:../admin/tambah_kategori");
			header('location: ?page='.$page);
		break;
		default:
			echo "$_GET[a]";
		break;
	}
	
    function insert($field,$data,$table,$con){
        $col = "";
        $val = "";
        $i=1;
        foreach($field as $lahan){
            $col = $col.$lahan;
            if($i<sizeof($field)){
                $col = $col.",";
            }
            $i++;
        }
        $i=1;
        foreach($data as $nilai){
            $val = "$val'$nilai'";
            if($i<sizeof($data)){
                $val = $val.",";
            }
            $i++;
        }
        $sql = "INSERT INTO $table($col) VALUES($val)";
        //echo $sql;
        mysqli_query($con,$sql);
    }

    function update($field,$data,$table,$id,$cond,$con){
        $set = "";
        for($i=0;$i<sizeof($field);$i++){
            $set = "$set$field[$i]='$data[$i]'";
            if($i+1<sizeof($field)){$set = $set.",";}
        }
        $sql = "UPDATE $table SET $set WHERE $cond = '$id'";
        //echo $sql;
        mysqli_query($con,$sql);
    }

    function delete($field,$table,$id,$con){
        $sql = "DELETE FROM $table WHERE $field = '$id'";
        //echo $sql;
        mysqli_query($con,$sql);
    }

    /*
    function deleteImage($id,$field,$table){
        $sql = "SELECT * FROM $table WHERE $field = '$id'";
        $q = mysql_query($sql);
        if($p=mysql_fetch_array($q)){
            if($table=="t_pohon"){
                unlink("../Image/Pohon/$p[gambar]");
            }
            else if($table=="t_gedung"){
                unlink("../Image/Gedung/$p[gambar]");
            }
        }
    }
    */
?>