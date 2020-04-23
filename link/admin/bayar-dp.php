<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Bayar DP ( ID Angsuran = <?php echo $_GET['id']; ?>)</h2>
		</div>
		<?php

		$query = mysqli_query($con,"SELECT t.id_transaksi,b.nama,a.harga_tambahan FROM tbl_transaksi t
								INNER JOIN tbl_pengajuan p ON(p.id_pengajuan = t.pengajuan)
								INNER JOIN tbl_barang b ON(b.id_barang = p.barang) 
								INNER JOIN tbl_angsuran a ON(t.id_transaksi = a.id_transaksi)
								WHERE t.id_transaksi = '$_GET[id]'");

		if($record = mysqli_fetch_array($query)){
			$minimum = 0.1*$record['harga_tambahan'];
			$min = number_format($minimum,0,',','.');
			echo "
			<div class='content-small green'><h3 class='content-title'><img src='../img/fax.svg' class='menu-icon' style='width:20px;'>Bayar DP</h3>
			<div class='content'>
					<form action='?page=bayar_dp&a=i_DP&id=$_GET[id]' method='post' enctype='multipart/form-data' >

						<label class='label-form'>ID Angsuran</label>
							<br/>
								<input type='text' id='id' name='id' value='$record[id_transaksi]' disabled class='form-dash'>
								<input type='hidden' id='id' name='id' value='$record[id_transaksi]'>	
							<br/>
						<label class='label-form'>Nama Barang</label>
							<br/>
							<input type='text' id='nama' name='nama' value='$record[nama]' disabled class='form-dash'>
							<br/>
						<label class='label-form'>Besaran DP<label class='red-color'> *</label></label>
							<div class='group'>
								<span class='group-tul'>Rp</span>
								<input type='text' class='form-dash' name='dp' id='dp' placeholder='Besaran DP' maxlength='20' onkeypress='return isNumber(event)' onchange='isMinimumDP(this, $minimum)'required>
							</div>
							<label class='label-form' id='notif' style='font-size:9pt'>DP minimum Rp$min</label>
							<br/>
						<label class='label-form' style='float:right'><small><label class='red-color'>*</label>) Wajib diisi</small></label><br/>

						<input type='submit' id='btnSub' value='Bayar DP' class='dash-button-blue' style='margin-top:10px;'/>

					</form>
				</div>
			</div>
			";
		}

		?>
		<!-- <input type='text' class='form-dash' name='dp' id='dp' placeholder='Besaran DP' maxlength='20' onkeypress='return isNumber(event)' onchange='isMinimumDP(this, $minimum)'required> -->
		<!--- TABEL ANGSURAN BELUM LUNAS -->
		
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>