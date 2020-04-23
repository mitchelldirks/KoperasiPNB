<div class="main-dash">
	<?php
	if(!isset($_GET['p'])){
		$_GET['p'] = 1;
	}

	if(!isset($_GET['h'])){
		$_GET['h'] = 1;
	}
	?>
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Angsuran</h2>
		</div>
		<!--- TABEL ANGSURAN BELUM LUNAS -->
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
						<td>Rp$total</td>
						<td>Rp$sisa</td>
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
		<?php
		//-------- Navigasi Halaman Sort
		echo "
		<div class='paging'>
			<center>
			<div class='paging-content'>";
			if($a_page != 1){
				echo "<a href='angsuran-".($a_page-1)."-$_GET[h]'>&laquo;</a>";
			}
			for($l=1;$l<=$pagecount;$l++){
				if($l == $a_page){
					echo"
						<a href='angsuran-$l-$_GET[h]' class='active'>$l</a>
					";
				}else{
					echo"
						<a href='angsuran-$l-$_GET[h]'>$l</a>
					";
				}
			}
			if($a_page != 1){
				echo "<a href='angsuran-".($a_page+1)."-$_GET[h]'>&raquo;</a>";
			}
			echo"
			</div>
			</center>
		</div>
		<div class='clear'></div>
		";
		//-------- Navigasi Halaman Sort
		?>
		<!--- TABEL ANGSURAN SUDAH LUNAS -->
		<div class="content-big green"><h3 class="content-title"><img src="img/check-circle.svg" class="menu-icon" style="width:20px;">Angsuran Yang Sudah Lunas</h3>
			<?php
			// --------------------------------Pagination
				$batas = 5;
				$sql = "SELECT * FROM tbl_angsuran a 
						INNER JOIN tbl_transaksi t ON(t.id_transaksi = a.id_transaksi)
						INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
						WHERE p.pengaju = '$_SESSION[user]' AND t.status = '1'
						";
				
				$query = mysqli_query($con,$sql);
				
				$count = mysqli_num_rows($query);
				$pagecount = ceil($count/$batas);

				if($pagecount == 0){$pagecount = 1;}

				if(!isset($_GET['h'])){
					$a_page = 1;
				}
				else{
					$a_page = $_GET['h'];
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
					<th>Tanggal Pelunasan</th>
				</tr>
				<?php
					$query = mysqli_query($con,"SELECT p.pengaju,p.id_pengajuan,b.nama,a.harga_tambahan,a.tgl_lunas,t.status 
											FROM tbl_pengajuan p
											INNER JOIN tbl_barang b ON(b.id_barang = p.barang)
											INNER JOIN tbl_transaksi t ON(t.pengajuan = p.id_pengajuan)
											INNER JOIN tbl_angsuran a ON(a.id_transaksi = t.id_transaksi)
											WHERE p.pengaju = $_SESSION[user] AND t.status = '1' LIMIT $mulai,$batas");

					$no = 1;
					while($record = mysqli_fetch_array($query)){
						$total = number_format($record['harga_tambahan'],0,',','.');
						$tgl = date("d F Y",strtotime($record['tgl_lunas']));

						echo "
						<tr>
							<td>$no</td>
							<td>$record[id_pengajuan]</td>
							<td>$record[nama]</td>
							<td>Rp$total</td>
							<td>$tgl</td>
						</tr>
						";
						$no++;
					}

					if(mysqli_num_rows($query) == 0){
						echo "
						<tr>
							<td colspan='5' style='font-size:10pt'>Maaf, data tidak tersedia</td>
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
				echo "<a href='angsuran-$_GET[p]-".($a_page-1)."'>&laquo;</a>";
			}
			for($l=1;$l<=$pagecount;$l++){
				if($l == $a_page){
					echo"
						<a href='angsuran-$_GET[p]-$l' class='active'>$l</a>
					";
				}else{
					echo"
						<a href='angsuran-$_GET[p]-$l'>$l</a>
					";
				}
			}
			if($a_page != 1){
				echo "<a href='angsuran-$_GET[p]-".($a_page+1)."'>&raquo;</a>";
			}
			echo"
			</div>
			</center>
		</div>
		<div class='clear'></div>
		";
		//-------- Navigasi Halaman Sort
		?>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>