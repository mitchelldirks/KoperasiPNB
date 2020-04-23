<?php 
if (isset($_POST['submit'])) {
	include 'belakang/database.php';

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
			//$id=$id;
			$id = addId($id, 'B');
			//echo "$id";
			$id++;
			$spec = nl2br($spec);
			$untuk = nl2br($untuk);

			$field = array("id_barang","nama","kategori","perkiraan_harga","gambar","spesifikasi");
            $isi = array($id,$nama,$kategori,$harga,$gambar,$spec);
            insert($field,$isi,"tbl_barang",$mysqli);
            //mysqli_query($con,'INSERT INTO tbl_barang (id_barang,nama,kategori,perkiraan_harga,gambar,spesifikasi) values ("$id","$nama","$kategori","$harga","$gambar","$spec") ');
            $field = array("pengaju","barang","peruntukan","status","jml_angsur");
            $isi = array($_SESSION['user'],$id,$untuk,0,$angsur);
            insert($field,$isi,"tbl_pengajuan",$mysqli);
            //mysqli_query($con,'INSERT INTO tbl_pengajuan (pengaju,barang,peruntukan,status,jml_angsur) values ("'.$_SESSION['user'].'","$id","$untuk",0,"$angsur") ');

            $_SESSION['notif'] = 1;
            // header("location:../admin/pengajuan");
            //header('location: ?page='.$page);
} ?>

<div class="main-dash">

	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Pengajuan</h2>
		</div>
		<?php
			if(isset($_SESSION['notif']) AND $_SESSION['notif']== 1){
				echo "
				<div class='wadah'>
					<div class='alert success' id='alert'><h4><img src='img/info-circle.svg' class='menu-icon' style='margin-right:5px;'>Alert</h4><button class='close' id='close' onClick='closeDiv()'>x</button><p>Pengajuan anda telah terkirim! <b>Silakan tunggu konfirmasi dari pihak Koperasi</b></p></div>
				</div>
				";
				unset($_SESSION['notif']);
			}
		?>
		<div class="content-medium green">
			<h3 class="content-title"><img src="img/edit.svg" class="menu-icon" style="width:20px;">Form Pengajuan Barang</h3>
			<div class="content">
			<form action="?page=pengajuan" method="post" enctype="multipart/form-data" >
					<label class="label-form">Nama Pengaju </label>
						<br/>
							<input type="text" id='pengaju' name="pengaju" value='<?php echo "$record[nama]"; ?>' disabled class="form-dash">
						<br/>
					<label class="label-form">Nama Barang<label class="red-color"> *</label></label>
						<br/>
						<input type="text" id='nama' name="Nama" placeholder="Nama Barang" maxlength="50" onchange='isOnlySpace(nama)' class="form-dash" required>
						<br/>
					<label class="label-form">Kategori Barang<label class="red-color"> *</label></label>
						<br/>
							<select name="kategori" class="form-dash" required>
								<option value="0">Pilih Kategori Barang</option>
								<?php
									$sql = "SELECT * FROM tbl_kategori_barang";

									$result = mysqli_query($con,$sql);
									
									while($rec = $result->fetch_array()){
										echo "<option value='$rec[id_kategori]'>$rec[kategori_barang]</option>";
									}

								?>
							</select>
						<br/>
					<label class="label-form">Perkiraan Harga Barang<label class="red-color"> *</label></label>
						<div class="group">
							<span class="group-tul">Rp</span>
							<input type="text" class="form-dash" name="harga" id='harga' placeholder="Perkiraan Harga" maxlength="20" onkeypress='return isNumber(event)' onchange="angsuran(this)" on required>
						</div>
						<br/>
					<!--- Gibran ini diisi otomatis besarannya, jadi pas user masukkin harga barang, otomatis keitung berapa angsurannya kira-kira -->
					
					<label class="label-form">Besaran Angsuran</label>
						<br/>
							<input type="hidden" id='gaji' value='<?php echo"$record[gaji_perbulan]"; ?>'>
							<input type="hidden" id='persen' value='<?php echo"$record[persentasi]"; ?>'>
							<select name='besar_angsur' class="form-dash">
								<option value="0" selected disabled>Pilih Jumlah Angsuran</option>
								<option value="3">3 kali</option>
								<option value="6">6 kali</option>
								<option value="12" selected>12 kali (Recommended)</option>
								<option value="24">24 kali</option>
							</select>
							<!--<input type="text" id='angsuran' name='angsuran' readonly class="form-dash">-->
						<br/>
					
					<label class="label-form">Gambar Barang<label class="red-color"> *</label></label>
						<br/>
						<input type="file" name="barang" required>
						<br/>
						<br/>
					<label class="label-form">Peruntukan Barang<label class="red-color"> *</label></label>
						<br/>
						<textarea cols="50" rows="6" name="Peruntukan" style="resize: none" onchange='isOnlySpace(this)' class="form-dash" required></textarea>
						
						<br/>
					<label class="label-form">Spesifikasi Barang<label class="red-color"> *</label></label>
						<br/>
						<textarea cols="50" rows="6" name="Spesifikasi" style="resize: none" onchange='isOnlySpace(this)' class="form-dash" required></textarea>
						<br/>
					<label class="label-form" style="float:right"><small><label class="red-color">*</label>) Wajib diisi</small></label><br/>

					<input type="submit" value="Ajukan Barang" name="submit" class="dash-button-blue" style="margin-top:10px;"/>
				</form>
			</div>
		</div>
		<div class="content-medium red" style="margin: 8px;margin-top: 0">
			<h3 class="content-title"><img src="img/question-circle.svg" class="menu-icon" style="width:20px;">Peraturan Pengajuan Barang</h3>
		<p align="justify" class="ml-2 mr-2">
			<ol>
				<li>Pengaju harus terlebih dahulu menjadi anggota dari Koperasi Patogu Nuansa Baru.</li>
				<li>Pengaju harus melengkapi dokumen sebagai bukti pendukung untuk keperluan survey</li>
				<li>Pengaju harus dalam keadaan sehat dan mampu</li>
				<li>Pengajuan harus disertai dengan data yang sebenarnya</li>
				<li>Kesalahan pada pengajuan bukan tanggung jawab </li>
				<li>Perkiraan Harga disini belum tentu sama dengan harga asli</li>
				<li>Biaya wajib pajak 10 persen, dan bunga 5 persen sebelum pajak</li>
			</ol>
		</p>
		</div>

		
		<div class="content-medium blue" style="margin: 8px">
			<h3 class="content-title"><img src="img/clipboard.svg" class="menu-icon" style="width:20px;">Dokumen
				<span class="pull-right"><a href="?page=dokumen" class="btn btn-warning"><img src="img/key.svg" class="menu-icon" style="width:20px;"></a></span>
			</h3>
		<p align="justify" class="ml-2 mr-2">
				Jika menurut anda diperlukan perubahan dokumen silakan lakukan <a href="?page=dokumen" style="color: blue;text-decoration: underline;">pengubahan</a>
			 <br>	<br>	

		Kelengkapan dan keabsahan dokumen menjadi pertimbangan serius untuk perihal pengajuan.</p>
			<h5 class="ml-2 mr-2">Preview Dokumen</h5>
		<div class="row">
			<?php 
			$doky=mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_dokumen where nik='".$_SESSION['user']."'"));
			$doc= array('KTP','KK','Ijazah','ATM');
			foreach ($doc as $dokumen ) { 
				$img = str_replace($_SESSION['user'], "", $doky[$dokumen]);
				?>
				<div class="col-lg-5 ml-2 mr-2">
						<!-- Button trigger modal -->
					<a data-toggle="modal" data-target="#<?=$dokumen?>">
						<div class="form-group">
							<h4>
								<center>
								<?=$dokumen?>
								</center>
								</h4>
							<img width="200px" src="img/dokumen/<?=$img?>">
						</div>
					</a>
				</div>
					      <!-- <div class="modal-body">

						    <span class="float-right"><?=$record["nik"]?>-<?=$record["nama"]?></span>
					        <center><img width="400px" src="img/dokumen/<?=$img?>"></center>	
					      </div> -->

					<div class="modal fade bd-example-modal-xl" id="<?=$dokumen?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-xl">
					    <div class="modal-content" style="padding: 20px;">
					    	<h5><?=$dokumen?>
						    <span class="float-right"><?=$record["nik"]?>-<?=$record["nama"]?></span></h5>
					        <center><img width="580px" src="img/dokumen/<?=$img?>"></center>
					    </div>
					  </div>
					</div>

			<?php } ?>
		</div>
		</div>

		<div class="clear"></div>

		<?php
		/*
		<div class="content-big grey" id='histori'><h3 class="content-title"><img src="img/clock.svg" class="menu-icon" style="width:20px;">Histori Pengajuan Barang</h3>
			<table class="table">
				<tr>
					<th style="width:20px;">No</th>
					<th>Tanggal Pengajuan</th>
					<th>ID Pengajuan</th>
					<th>Nama Barang</th>
					<th>Kategori</th>
					<th>Harga</th>
					<th>Status</th>
				</tr>
			
				// --------------------------------Pagination
					$batas = 5;
					$sql = "SELECT * FROM tbl_pengajuan WHERE status = 0";
					
					$query = mysqli_query($con,$sql);
					
					$count = mysqli_num_rows($query);
					$pagecount = ceil($count/$batas);

					if(!isset($_GET['p'])){
						$a_page = 1;
					}
					else{
						$a_page = $_GET['p'];
					}
					
					$mulai = $batas *($a_page-1);
				// --------------------------------Pagination
				$query = mysqli_query($con,
					"SELECT p.id_pengajuan,p.pengaju,p.tgl_pengajuan,b.nama,k.kategori_barang,b.perkiraan_harga,p.status
					 FROM tbl_pengajuan p INNER JOIN tbl_anggota a ON(a.nik = p.pengaju) INNER JOIN tbl_barang b 
					 ON(b.id_barang = p.barang) INNER JOIN tbl_kategori_barang k ON (k.id_kategori = b.kategori) WHERE p.pengaju = '$_SESSION[user]' LIMIT $mulai,$batas"
					);
				$no = 1;
				while ($record = mysqli_fetch_array($query)) {
					$tgl = date("d F Y", strtotime($record['tgl_pengajuan']));
					$money = number_format($record['perkiraan_harga'],0,",",".");
					echo "
						<tr>
							<td>$no</td>
							<td>$tgl</td>
							<td>$record[id_pengajuan]</td>
							<td>$record[nama]</td>
							<td>$record[kategori_barang]</td>
							<td>Rp$money</td>";
							switch ($record['status']) {
								case 0:
									echo "<td><button class='dash-button-blue' style='margin:0px;'>Dalam Proses</button></td>";
								break;
								case 1:
									echo "<td><button class='dash-button-green' style='margin:0px;'>Diterima</button></td>";
								break;
								case 2:
									echo "<td><button class='dash-button-red' style='margin:0px;'>Ditolak</button></td>";
								break;
							}
							echo"
						</tr>
					";
				}	
			?>
			</table>
		</div>
		<?php
		//-------- Navigasi Halaman Sort
		echo "
		<div class='paging'>
			<center>
			<div class='paging-content'>
				<a href='#'>&laquo;</a>";
			for($l=1;$l<=$pagecount;$l++){
				if($l == $a_page){
					echo"
						<a href='pengajuan-$l#histori' class='active'>$l</a>
					";
				}else{
					echo"
						<a href='pengajuan-$l#histori'>$l</a>
					";
				}
			}
			echo"
				<a href='#'>&raquo;</a>
			</div>
			</center>
		</div>
		<div class='clear'></div>
		";
		//-------- Navigasi Halaman Sort
		*/
		?>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>