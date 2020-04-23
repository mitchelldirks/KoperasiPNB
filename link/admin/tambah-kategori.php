<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Tambah Kategori Barang</h2>
		</div>
		<?php
		if(isset($_SESSION['notif']) AND $_SESSION['notif']== 1){
			echo "
			<div class='wadah'>
				<div class='alert success' id='alert'><h4><img src='img/info-circle.svg' class='menu-icon' style='margin-right:5px;'>Alert</h4><button class='close' id='close' onClick='closeDiv()'>x</button><p>Kategori berhasil ditambahkan</p></div>
			</div>
			";
			unset($_SESSION['notif']);
		}
		?>
		<!--- TABEL ANGSURAN BELUM LUNAS -->
		<div class="content-semi-big grey"><h3 class="content-title"><img src="img/list-alt.svg" class="menu-icon" style="width:20px;">List Kategori Barang</h3>
			<table class="table">
				<?php
				// --------------------------------Pagination
					$batas = 10;
					$sql = "SELECT * FROM tbl_kategori_barang";
					
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
					<th>ID Pekerjaan</th>
					<th>Nama Pekerjaan</th>
				</tr>
				
				<?php

					$query = mysqli_query($con,"SELECT * FROM tbl_kategori_barang");
					$no = 1;
					$id="";
					while($record = mysqli_fetch_array($query)){
						$id = $record['id_kategori'];
						echo "
						<tr>
							<td>$no</td>
							<td>$id</td>
							<td>$record[kategori_barang]</td>
						</tr>
						";
						$no++;
					}
				?>
			</table>
			<div class="paging">
				<center>
				<div class="paging-content">
					<?php
						if($a_page != 1){
							echo"<a href='tambah_kategori-".($a_page-1)."'>&laquo;</a>";
						}
					
						for($l = 1; $l <= $pagecount; $l++){
							if($l == $a_page){
								echo "<a href='#' class='active'>$l</a>";
							}else{
								echo "<a href='tambah_kategori-$l>$l</a>";
							}
						}
					
						if($a_page != $pagecount){
							echo"<a href='tambah_kategori-".($a_page+1)."'>&raquo;</a>";
						}
					?>
				</div>
				</center>
			</div>
		</div>
		<div class="content-small green"><h3 class="content-title"><img src="img/id-card.svg" class="menu-icon" style="width:20px;">Form Tambah Kategori</h3>
		<div class="content">
				<form action="?page=tambah_kategori&a=i_kategori" method="post" enctype="multipart/form-data" >
					<label class="label-form">ID Kategori</label>
						<br/>
							<input type="text" id='id' name="id" value='' disabled class="form-dash">
							<input type="hidden" id='id2' name="id" value='<?php echo $id; ?>'>
						<br/>
					<label class="label-form">Kategori<label class="red-color"> *</label></label>
						<br/>
						<?php
						echo"
						<input type='text' id='kat' name='kat' placeholder='Kategori Barang' class='form-dash' onchange='makeID(id2,$no,\"K\")'>";
						?>
						<br/>
					<label class="label-form" style="float:right"><small><label class="red-color">*</label>) Wajib diisi</small></label><br/>

					<input type="submit" value="Tambah Kategori" class="dash-button-blue" style="margin-top:10px;"/>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>