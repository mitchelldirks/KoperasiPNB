<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title"><h2>Beranda</h2></div>

				<div class='col-lg-9 btn btn-success' style='border:1px solid #CCC'>
					<span class="pull-left">Jumlah pengajuan atas nama <?=$record['nama']?> </span>
					<span class="pull-right"><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM tbl_pengajuan p WHERE p.status = 3 and pengaju = '$_SESSION[user]'")); ?></span>
				</div>
			<?php 
			$query = mysqli_query($con,"SELECT a.id_angsuran,p.id_pengajuan,b.nama,a.harga_tambahan,a.tgl_lunas FROM tbl_angsuran a 
										INNER JOIN tbl_transaksi t ON(t.id_transaksi = a.id_transaksi)
										INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
										INNER JOIN tbl_barang b ON(b.id_barang = p.barang)
										WHERE p.pengaju = '$_SESSION[user]' AND t.status = '0'");
			if (mysqli_num_rows($query)>0): ?>
				
				<div class="content-big red"><h3 class="content-title"><img src="img/times-circle.svg" class="menu-icon" style="width:20px;">Angsuran Yang Belum Lunas</h3>
			<?php
			// --------------------------------Pagination
				$batas = 5;
				$sql = "SELECT * FROM tbl_angsuran a 
						INNER JOIN tbl_transaksi t ON(t.id_transaksi = a.id_transaksi)
						INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
						WHERE p.pengaju = '$_SESSION[user]' AND t.status = '0'
						";
				
				$query = mysqli_query($con,$sql);
				
				$count = mysqli_num_rows($query);
				$pagecount = ceil($count/$batas);

				if($pagecount == 0){$pagecount = 1;}

				if(!isset($_GET['p'])){
					$a_page = 1;
				}
				else{
					$a_page = $_GET['p'];
				}
				
				$mulai = $batas *($a_page-1);
			// --------------------------------Pagination
			?>
			<table class="table">
				<tr>
					<th style="width:20px;">No</th>
					<th>ID Pengajuan</th>
					<th>Nama Barang</th>
					<th>Total Angsuran</th>
					<th>Sisa Angsuran</th>
					<th>Tanggal Akhir Pelunasan</th>
				</tr>
				<?php

				$query = mysqli_query($con,"SELECT a.id_angsuran,p.id_pengajuan,b.nama,a.harga_tambahan,a.tgl_lunas FROM tbl_angsuran a 
										INNER JOIN tbl_transaksi t ON(t.id_transaksi = a.id_transaksi)
										INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
										INNER JOIN tbl_barang b ON(b.id_barang = p.barang)
										WHERE p.pengaju = '$_SESSION[user]' AND t.status = '0' LIMIT $mulai,$batas");

				$no = 1;
				while ($record = mysqli_fetch_array($query)){
					$q = mysqli_query($con,"SELECT a.dp, (a.harga_tambahan - SUM(d.besar_angsuran)) sisa 
							FROM tbl_detail_angsuran d 
							INNER JOIN tbl_angsuran a ON(d.id_angsuran = a.id_angsuran) 
							WHERE d.id_angsuran = '$record[id_angsuran]' GROUP BY d.id_angsuran");

					$terbayar = 0;
					$dp = 0;

					if($rcd = $q->fetch_array()){
						$terbayar = $rcd['sisa'];
						$dp = $rcd['dp'];
					}

					$tgl = date("d F Y", strtotime($record['tgl_lunas']));
					$total = number_format($record['harga_tambahan'],0,",",".");
					$sisa = number_format(($terbayar-$dp),0,",",".");

					echo "
					<tr>
						<td>$no</td>
						<td>$record[id_pengajuan]</td>
						<td>$record[nama]</td>
						<td>Rp. $total</td>
						<td>Rp. $sisa</td>
						<td>$tgl</td>
					</tr>
					";
					$no++;
				}

				if(mysqli_num_rows($query) == 0){
					echo "
					<tr>
						<td colspan='6' style='font-size:10pt'>Maaf, data tidak tersedia</td>
					</tr>
					";
				}
				
				?>
			</table>
		</div>
			<?php else: ?>
			<?php endif ?>


		<!-- <div class="content-big"><h3 class="content-title">Some Title</h3></div> -->
		<?php
		// --------------------------------Pagination
			$batas = 2;
			$sql = "SELECT * FROM tbl_pengajuan WHERE status = 3";
			
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
			// $query = mysqli_query($con,"SELECT a.nik,p.id_pengajuan,p.tgl_pengajuan,a.nama nama_anggota ,a.alamat,j.nama_pekerjaan pekerjaan,a.gaji_perbulan,b.nama,k.kategori_barang,b.perkiraan_harga,b.spesifikasi,p.peruntukan, p.status,b.gambar,p.jml_angsur FROM tbl_pengajuan p INNER JOIN tbl_barang b ON(b.id_barang = p.barang)  INNER JOIN tbl_anggota a ON (a.nik = p.pengaju) INNER JOIN tbl_kategori_barang k ON  (k.id_kategori = b.kategori) INNER JOIN tbl_pekerjaan j ON (j.id_pekerjaan = a.pekerjaan)  WHERE p.status = 6 LIMIT $mulai,$batas");
			$query = mysqli_query($con,"SELECT * FROM tbl_pengajuan p WHERE p.status = 3 and pengaju = '$_SESSION[user]'");

			while($record = mysqli_fetch_array($query)){
			$barang = mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_barang where id_barang='".$record['barang']."'"));
			$anggota = mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_anggota where nik='".$record['pengaju']."'"));
			$kategori = mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_kategori_barang where id_kategori='".$barang['kategori']."'"));
			$pekerjaan = mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_pekerjaan where id_pekerjaan='".$anggota['pekerjaan']."'"));
			$transaksi = mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_transaksi where pengajuan='".$record['id_pengajuan']."'"));
			$angsuran = mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_angsuran where id_transaksi='".$transaksi['id_transaksi']."'"));
				$tgl = date("d F Y", strtotime($record['tgl_pengajuan']));
				$money = number_format($barang['perkiraan_harga'],0,",",".");
				$gaji = number_format($anggota['gaji_perbulan'],0,",",".");
				$total = number_format($angsuran['harga_tambahan'],0,',','.');
				// $beli = number_format($barang['harga_asli'],0,",",".");
				if ($transaksi['status']==0) {
					$status='<span class="btn btn-danger" style="color: white;">Belum Lunas</span>';
				}else{
					$status='<span style="color: green;">Lunas</span>';
				}
				echo "
				<a href='?page=barang&id=$record[id_pengajuan]'>
				<div class='content-small' style='border:1px solid #CCC'>
					<h3 class='content-title' style='font-size:12pt;'>$anggota[nama]</h3>"; ?>
						<div class='container-img-beranda' style="background-image:url('img/barang/<?=$barang['gambar']?>');"></div> <?php echo"

						<div class='aju-det-beranda'>
							<table>
								<tr><td>Barang</td><td>:</td><td>$barang[nama]</td></tr>
								<tr><td>Harga</td><td>:</td><td>Rp. $total</td></tr>
								<tr><td>Tanggal</td><td>:</td><td>$tgl</td></tr>
								<tr><td>Status</td><td>:</td><td>$status</td></tr>
							</table>
						</div>
					</div>
				</div>
				</a>
				";
			}//<tr><td>Harga Beli</td><td>:</td><td>Rp$beli</td></tr>

		?>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>