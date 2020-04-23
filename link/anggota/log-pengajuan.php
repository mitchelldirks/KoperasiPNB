<div class="main-dash">

	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Log Pengajuan Barang</h2>
		</div>
		<div class="content-big grey" id='histori'><h3 class="content-title"><img src="img/clock.svg" class="menu-icon" style="width:20px;">Log Pengajuan Barang</h3>
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
			<?php
				// --------------------------------Pagination
					$batas = 5;
					$sql = "SELECT * FROM tbl_pengajuan WHERE pengaju = '$_SESSION[user]' AND status < 3";
					
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
				$query = mysqli_query($con,
					"SELECT p.id_pengajuan,p.pengaju,p.tgl_pengajuan,b.nama,k.kategori_barang,b.perkiraan_harga,p.status
					 FROM tbl_pengajuan p INNER JOIN tbl_anggota a ON(a.nik = p.pengaju) INNER JOIN tbl_barang b 
					 ON(b.id_barang = p.barang) INNER JOIN tbl_kategori_barang k ON (k.id_kategori = b.kategori) WHERE p.pengaju = '$_SESSION[user]' AND p.status < 3 LIMIT $mulai,$batas"
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

				if(mysqli_num_rows($query) == 0){
					echo "
					<tr>
						<td colspan='7' style='font-size:10pt'>Maaf, data tidak tersedia</td>
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
			<div class='paging-content'>";

				if($a_page != 1){
					echo"<a href='log_pengajuan-".($a_page-1)."-$_GET[h]'>&laquo;</a>";
				}
			
				for($l = 1; $l <= $pagecount; $l++){
					if($l == $a_page){
						echo "<a href='#' class='active'>$l</a>";
					}else{
						echo "<a href='log_pengajuan-$l-$_GET[h]'>$l</a>";
					}
				}
			
				if($a_page != $pagecount){
					echo"<a href='log_pengajuan-".($a_page+1)."-$_GET[h]'>&raquo;</a>";
				}

			echo"
			</div>
			</center>
		</div>
		<div class='clear'></div>
		";
		//-------- Navigasi Halaman Sort
		// --------------------------------Pagination
			$batas = 5;
			$sql = "SELECT * FROM tbl_pengajuan WHERE pengaju = '$_SESSION[user]' AND status = '3'";
			
			$query = mysqli_query($con,$sql);
			
			$count = mysqli_num_rows($query);
			$pagecount = ceil($count/$batas);

			if($pagecount == 0){$pagecount = 1;}

			if(!isset($_GET['h'])){
				$b_page = 1;
			}
			else{
				$b_page = $_GET['h'];
			}
			
			$mulai = $batas *($b_page-1);
		// --------------------------------Pagination
		?>
		<div class="content-big green"><h3 class="content-title"><img src="img/envelope.svg" class="menu-icon" style="width:20px;">Barang yang sudah ada di koperasi</h3>
			<table class="table">
				<tr>
					<th style="width:20px;">No</th>
					<th>Tanggal Pengajuan</th>
					<th>ID Pengajuan</th>
					<th>Nama Barang</th>
					<th>Harga Perkiraan</th>
					<th>Harga Asli</th>
					<th>Min. Angsuran / Bulan</th>
				</tr>
				<?php

				$query = mysqli_query($con,"SELECT p.tgl_pengajuan,p.id_pengajuan,b.nama,b.perkiraan_harga,
					t.harga_asli,(a.harga_tambahan - a.dp) total,t.banyak_angsuran FROM tbl_pengajuan p 
					INNER JOIN tbl_barang b ON(b.id_barang = p.barang)
					INNER JOIN tbl_transaksi t ON(t.pengajuan = p.id_pengajuan)
					INNER JOIN tbl_angsuran a ON(a.id_transaksi = t.id_transaksi)
					WHERE p.pengaju = '$_SESSION[user]' AND p.status='3' LIMIT $mulai,$batas");

				$no = 1;
				while($record = mysqli_fetch_array($query)){
					$tgl = date("d F Y", strtotime($record['tgl_pengajuan']));
					$perkiraan = number_format($record['perkiraan_harga'],0,",",".");
					$asli = number_format($record['harga_asli'],0,",",".");
					$minCicil = number_format(($record['total'] / $record['banyak_angsuran']),0,",",".");

					echo "
					<tr>
						<td>$no</td>
						<td>$tgl</td>
						<td>$record[id_pengajuan]</td>
						<td>$record[nama]</td>
						<td>Rp$perkiraan</td>
						<td>Rp$asli</td>
						<td>Rp$minCicil</td>
					</tr>
					";
					$no++;
				}

				if(mysqli_num_rows($query) == 0){
					echo "
					<tr>
						<td colspan='7' style='font-size:10pt'>Maaf, data tidak tersedia</td>
					</tr>
					";
				}

				?>
			</table>
		</div>
		
	</div>
	<?php
		//-------- Navigasi Halaman Sort
		echo "
		<div class='paging'>
			<center>
			<div class='paging-content'>";
				if($b_page != 1){
					echo"<a href='log_pengajuan-$_GET[p]-".($b_page-1)."'>&laquo;</a>";
				}
			
				for($l = 1; $l <= $pagecount; $l++){
					if($l == $b_page){
						echo "<a href='#' class='active'>$l</a>";
					}else{
						echo "<a href='log_pengajuan-$_GET[p]-$l'>$l</a>";
					}
				}
			
				if($b_page != $pagecount){
					echo"<a href='log_pengajuan-$_GET[h]-".($b_page+1)."'>&raquo;</a>";
				}
			echo"
			</div>
			</center>
		</div>
		<div class='clear'></div>
		";
		//-------- Navigasi Halaman Sort
	?>
	<div class="clear"></div>
</div>