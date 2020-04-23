<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Ubah Password</h2>
		</div>
		<!--- TABEL ANGSURAN BELUM LUNAS -->
		<div class="content-medium green"><h3 class="content-title"><img src="img/key.svg" class="menu-icon" style="width:20px;">Form Ubah Password</h3>
			<form action="?page=security&a=p_changePassword" method="POST">
			<br/>
				<label class="label-form">Password Sekarang<label class="red-color"> *</label></label>
				<br/>
					<input type="password" id='oldPassword' name="oldPassword" placeholder="Current Password" class="form-dash" required>
				<br/>
				<label class="label-form">Password Baru<label class="red-color"> *</label></label>
				<br/>
					<input type="password" id='newPassword' name="newPassword" placeholder="New Password" class="form-dash" required>
				<br/>
				<label class="label-form">Ulangi Password Baru<label class="red-color"> *</label></label>
				<br/>
					<input type="password" id='conPassword' name="conPassword" placeholder="Confirm Password" class="form-dash" onchange="isValid(this,newPassword)" required>
				<br/>
				<label class="label-form" style="float:right"><small><label class="red-color">*</label>) Wajib diisi</small></label><br/>

				<input type="submit" id='btnsub' value="Ubah Password" class="dash-button-blue" style="margin-top:10px;"/>
			</form>
		</div>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>

<?php
	if(empty($_SESSION['valid'])){
		$_SESSION['valid'] = 2;
	}else if(isset($_SESSION['valid']) == 0){
		echo"
			<script>window.alert('Maaf, Password lama anda tidak valid');</script>
		";
	}else if(isset($_SESSION['valid']) == 1){
		echo"
			<script>window.alert('Password Berhasil diubah');</script>
		";
		unset($_SESSION['valid']);
	}
?>