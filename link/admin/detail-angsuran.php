<div class="main-dash">
	<?php
		$query = mysqli_query($con,"SELECT harga_asli FROM tbl_transaksi WHERE id_transaksi = '$_GET[id]'");

		if($record = mysqli_fetch_array($query)){
			$asli = $record['harga_asli'];
		}
	?>
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Angsuran</h2>
		</div>
		<?php
			if(isset($_SESSION['notif']) AND $_SESSION['notif']== 1){
				echo "
				<div class='wadah'>
					<div class='alert success' id='alert'><h4><img src='../img/info-circle.svg' class='menu-icon' style='margin-right:5px;'>Alert</h4><button class='close' id='close' onClick='closeDiv()'>x</button><p>Angsuran berhasil dibayarkan</p></div>
				</div>
				";
				unset($_SESSION['notif']);
			}else if(isset($_SESSION['notif']) AND $_SESSION['notif']== 2){
				echo "
				<div class='wadah'>
					<div class='alert success' id='alert'><h4><img src='../img/info-circle.svg' class='menu-icon' style='margin-right:5px;'>Alert</h4><button class='close' id='close' onClick='closeDiv()'>x</button><p>DP berhasil dibayarkan</p></div>
				</div>
				";
				unset($_SESSION['notif']);
			}
		?>
		<!--- TABEL ANGSURAN BELUM LUNAS -->
		<div class="content-semi-big grey"><h3 class="content-title"><img src="img/list-alt.svg" class="menu-icon" style="width:20px;">Detail Angsuran (ID = <?php echo $_GET['id']; ?>)</h3>
			<table class="table">
				<?php
				// --------------------------------Pagination
					$batas = 10;
					$sql = "SELECT * FROM tbl_detail_angsuran WHERE id_angsuran = '$_GET[id]'";
					
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
				<tr>
					<th style="width:20px;">No</th>
					<th>Nama Barang</th>
					<th>Total Angsuran</th>
					<th>Besaran Pembayaran</th>
					<th>Sisa Angsuran</th>
					<th>Tanggal Pembayaran</th>
					<th>Angsuran Ke</th>
				</tr>
				
				<?php
					$query = mysqli_query($con,"SELECT a.dp,d.id_detail,d.id_angsuran,b.nama,a.harga_tambahan,
														 d.besar_angsuran,d.tgl_angsuran,t.banyak_angsuran,t.harga_asli 
											FROM tbl_detail_angsuran d 
											INNER JOIN tbl_angsuran a ON(a.id_angsuran = d.id_angsuran)
											INNER JOIN tbl_transaksi t ON(t.id_transaksi = a.id_transaksi)
											INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
											INNER JOIN tbl_barang b ON(b.id_barang = p.barang)
											WHERE d.id_angsuran = $_GET[id] LIMIT $mulai,$batas");
					$no = 1;
					$sisa = -1;
					$dp = 0;
					while($record = mysqli_fetch_array($query)){
						if($sisa == -1){
							$sisa = $record['harga_tambahan'] - $record['dp'];
						}
						$tgl = date("d F Y", strtotime($record['tgl_angsuran']));
						$money = number_format($record['harga_tambahan'],0,",",".");
						$bayar = number_format($record['besar_angsuran'],0,",",".");
						$dp = $record['dp'];
						$asli = $record['harga_asli'];

						$sisa = $sisa - $record['besar_angsuran'];
						$uang = number_format($sisa,0,",",".");

						echo
						"<tr>
							<td>$no</td>
							<td>$record[nama]</td>
							<td>Rp. $money</td>
							<td>Rp. $bayar</td>
							<td>Rp. $uang</td>
							<td>$tgl</td>
							<td>$no/$record[banyak_angsuran]</td>
						</tr>";
						$no++;
					}

					if($query->num_rows == 0){
						echo "
						<tr>
							<td colspan='8' style='font-size:10pt'>Maaf, data tidak tersedia</td>
						</tr>
						";
					}
				?>
			</table>
			<div class="paging">
				<center>
				<div class="paging-content">
					<?php
						if($a_page != 1){
							echo"<a href='?page=detail_angsuran&id=$_GET[id]-".($a_page-1)."'>&laquo;</a>";
						}
					
						for($l = 1; $l <= $pagecount; $l++){
							if($l == $a_page){
								echo "<a href='#' class='active'>$l</a>";
							}else{
								echo "<a href='?page=detail_angsuran&id=$_GET[id]-$l'>$l</a>";
							}
						}
					
						if($a_page != $pagecount){
							echo"<a href='?page=detail_angsuran&id=$_GET[id]-".($a_page+1)."'>&raquo;</a>";
						}
					?>
				</div>
				</center>
			</div>

			<?php
				if($dp == 0 && $asli > 10000000){
					echo"<a href='?page=bayar_dp&id=$_GET[id]'><button class='dash-button-orange'>Bayar DP</button></a>";
				}
			?>
			
		</div>
		<?php

		$query = mysqli_query($con,"SELECT * FROM tbl_detail_angsuran WHERE id_angsuran = '$_GET[id]'");
		$count = mysqli_num_rows($query);
		$count = $count+1;

		$query = mysqli_query($con,"SELECT an.dp,an.id_angsuran,b.nama,t.banyak_angsuran,an.harga_tambahan FROM tbl_angsuran an
								INNER JOIN tbl_transaksi t ON(t.id_transaksi = an.id_transaksi)
								INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
								INNER JOIN tbl_barang b ON(p.barang = b.id_barang)
								WHERE an.id_angsuran = '$_GET[id]'");

		if($record = mysqli_fetch_array($query)){
			$minimum = ($record['harga_tambahan'] - $record['dp'])/$record['banyak_angsuran'];
			$min = number_format($minimum,0,",",".");
			if ($uang > 0) {
			echo "
			<div class='content-small green'><h3 class='content-title'><img src='img/fax.svg' class='menu-icon' style='width:20px;'>Bayar Angsuran (ke-$count/$record[banyak_angsuran])</h3>
			<div class='content'>
					<form action='?page=detail_angsuran&a=p_mengangsur&id=$_GET[id]' method='post' enctype='multipart/form-data' >
						<label class='label-form'>ID Angsuran</label>
							<br/>
								<input type='hidden' id='id' name='id' value='$record[id_angsuran]'>
								<input type='text' id='' name='' value='$record[id_angsuran]' disabled class='form-dash'>	
							<br/>
						<label class='label-form'>Nama Barang</label>
							<br/>
								<input type='text' value='$record[nama]' disabled class='form-dash'>
							<br/>
						<label class='label-form'>Besaran Angsuran<label class='red-color'> *</label></label>
							<div class='group'>
								<span class='group-tul'>Rp</span>
								<input type='text' class='form-dash' name='angsuran' id='angsuran' placeholder='Besaran Angsuran' maxlength='20' onkeypress='return isNumber(event)' onchange='isMinimum(this,$minimum)' required>
							</div>
							<label class='label-form' id='notif' style='font-size:9pt'>Angsuran minimum Rp$min</label>
							<br/>
						<label class='label-form' style='float:right'><small><label class='red-color'>*</label>) Wajib diisi</small></label><br/>

						<input type='submit' id='btnSub' value='Bayar Angsuran' class='dash-button-blue' style='margin-top:10px;'/>
					</form>
				</div>
			</div>";
			}else{
				echo "
			<div class='content-small green'><h3 class='content-title'><img src='img/fax.svg' class='menu-icon' style='width:20px;'>Angsuran lunas</h3>
			</div>";
			}
		}
	
		?>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>