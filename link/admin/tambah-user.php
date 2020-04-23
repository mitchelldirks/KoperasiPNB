<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Tambah Anggota</h2>
		</div>
		<div class="content-big green">
			<h3 class="content-title"><img src="img/edit.svg" class="menu-icon" style="width:20px;">Form Tambah Anggota</h3>
			<div class="content">
			<form action="?page=data_user&a=i_anggota" method="post" enctype="multipart/form-data" >
					<label class="label-form">NIK<label class="red-color"> *</label></label>
						<br/>
							<input type="text" id='nik' name="nik" class="form-dash" placeholder='Nomor Induk Kependudukan' maxlength='16' onkeypress='return isNumber(event)' onchange="not16Digit(this)" required>
							<label class='label-form' id='notif' style='font-size:9pt'></label>
						<br/>
					<label class="label-form">Nama Anggota<label class="red-color"> *</label></label>
						<br/>
						<input type="text" id='nama' name="Nama" placeholder="Nama Anggota" maxlength="50" onchange='isOnlySpace(nama)' class="form-dash" required>
						<br/>
					<label class="label-form">Pekerjaan<label class="red-color"> *</label></label>
						<br/>
							<div class="group" style="width:100%;">
								<select name="pekerjaan" class="form-dash"  style="width:100%;">
									<option value="0">Pilih Pekerjaan</option>

									<?php
										$query = mysqli_query($con,"SELECT * FROM tbl_pekerjaan order by nama_pekerjaan");

										while($record = mysqli_fetch_array($query)){
											echo "<option value='$record[id_pekerjaan]'>$record[nama_pekerjaan]</option>";
										}
									?>
									
								</select>
								<a href="?page=tambah_pekerjaan" class="group-tul-3">+ Tambah Pekerjaan</a>
							</div>
						<br/>
					<label class="label-form">Gaji/Bulan<label class="red-color"> *</label></label>
						<div class="group">
							<span class="group-tul">Rp</span>
							<input type="text" class="form-dash" name="gaji" id='' placeholder="Gaji/Bulan" maxlength="20" onkeypress='return isNumber(event)' onchange="numberFormat(this)" required>
						</div>
						<br/>
					<label class="label-form">Presentasi Gaji/Bulan<label class="red-color"> *</label></label>
						<br/>
							<div class="group">
								<input type="text" class="form-dash" name="persen" id='' placeholder="Presentasi Gaji/Bulan" maxlength="3" onkeypress='return isNumber(event)' onchange="moreThan100(this)" required>
								<span class="group-tul-2">%</span>
							</div>
							<label class='label-form' id='notif2' style='font-size:9pt'></label>
						<br/>
					<label class="label-form">Alamat Anggota<label class="red-color"> *</label></label>
						<br/>
						<textarea cols="50" rows="6" name="alamat" style="resize: none" onchange='isOnlySpace(this)' class="form-dash" required></textarea>
						
						<br/>
					<label class="label-form" style="float:right"><small><label class="red-color">*</label>) Wajib diisi</small></label><br/>

					<input type="submit" id='btnSub' value="Tambah Anggota" class="dash-button-blue" style="margin-top:10px;"/>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>