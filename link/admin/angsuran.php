<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Angsuran</h2>
		</div>
		<!--- TABEL ANGSURAN BELUM LUNAS -->
		<div class="content-big grey"><h3 class="content-title"><img src="img/fax.svg" class="menu-icon" style="width:20px;">List Angsuran</h3>
			<table class="table">
				<?php
				// --------------------------------Pagination
					$batas = 5;
					$sql = "SELECT * FROM tbl_angsuran a 
							INNER JOIN tbl_transaksi t ON(a.id_transaksi = t.id_transaksi)
							WHERE t.status = '0'";
					
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
				<tr>
					<th style="width:20px;">No</th>
					<th>ID Pengajuan</th>
					<th>Nama Barang</th>
					<th>Total Angsuran</th>
					<th>Sisa Angsuran</th>
					<th>Tanggal Akhir Pelunasan</th>
					<th>Opsi</th>
				</tr>
				<?php
					$query = mysqli_query($con,"SELECT a.id_angsuran,t.pengajuan,b.nama,a.harga_tambahan,a.tgl_lunas,t.status FROM tbl_angsuran a 
						INNER JOIN tbl_transaksi t ON(t.id_transaksi = a.id_transaksi) 
						INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
						INNER JOIN tbl_barang b ON (b.id_barang = p.barang)
						WHERE t.status = '0' LIMIT $mulai,$batas");

					$i = 1;
					while($record = mysqli_fetch_array($query)){
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

						if($terbayar == 0){
							$terbayar = $record['harga_tambahan'];
						}

						$tgl = date("d F Y", strtotime($record['tgl_lunas']));
						$money = number_format($record['harga_tambahan'],0,",",".");
						$terbayar = number_format(($terbayar-$dp),0,",",".");

						echo "
						<tr>
							<td>$i</td>
							<td>$record[pengajuan]</td>
							<td>$record[nama]</td>
							<td>Rp$money</td>
							<td>Rp$terbayar</td>
							<td>$tgl</td>
							<td><a href='?page=detail_angsuran&id=$record[id_angsuran]'><button class='dash-button-blue' style='margin-top:0px;'>Detail</button></a></td>
						</tr>";
						$i++;
					}

					if($query->num_rows == 0){
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
					echo"<a href='angsuran-".($a_page-1)."'>&laquo;</a>";
				}

				for($l=1;$l<=$pagecount;$l++){
					if($l == $a_page){
						echo"
							<a href='angsuran-$l' class='active'>$l</a>
						";
					}else{
						echo"
							<a href='angsuran-$l'>$l</a>
						";
					}
				}

				if($a_page != $pagecount){
					echo"<a href='angsuran-".($a_page+1)."'>&raquo;</a>";
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
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>