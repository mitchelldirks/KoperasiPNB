<style type="text/css">
	
</style>
<div class="main-dash">
	<?php
	// --------------------------------Pagination
		$batas = 5;
		$sql = "SELECT * FROM tbl_anggota";
		
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
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title">
			<h2>Data Anggota</h2>
		</div>
		<?php
		if(isset($_SESSION['notif']) AND $_SESSION['notif']== 1){
			echo "
			<div class='wadah'>
				<div class='alert success' id='alert'><h4><img src='img/info-circle.svg' class='menu-icon' style='margin-right:5px;'>Alert</h4><button class='close' id='close' onClick='closeDiv()'>x</button><p>Anggota berhasi ditambahkan</p></div>
			</div>
			";
			unset($_SESSION['notif']);
		}
		?>
		<div class="content-big grey"><h3 class="content-title"><img src="img/users.svg" class="menu-icon" style="width:20px;">List Anggota Koperasi</h3>
			<a href="?page=tambah_anggota"><button class="dash-button-green"><b>+ Tambah Anggota</b></button></a>
			<table class="table table-hover">
				<tr>
					<th style="width:25px;">No</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Pekerjaan</th>
					<th>Gaji/Bulan</th>
					<th>Presentasi Gaji</th>
					<!-- <th>Dokumen</th> -->
				</tr>
				<?php
					$query = mysqli_query($con,"SELECT a.nik,a.nama,a.alamat,p.nama_pekerjaan,a.gaji_perbulan,
											a.persentasi,u.hak_akses FROM tbl_anggota a 
											INNER JOIN tbl_pekerjaan p ON(p.id_pekerjaan = a.pekerjaan)
											INNER JOIN tbl_user u ON(u.username = a.nik)
											WHERE u.hak_akses = 'ANGGOTA'");

					$no = 1;
					while($record = mysqli_fetch_array($query)){
						$gaji = number_format($record['gaji_perbulan'],0,',','.');
						echo "
						<tr>
							<td>$no</td>
							<td>$record[nik]</td>
							<td>$record[nama]</td>
							<td>$record[alamat]</td>
							<td>$record[nama_pekerjaan]</td>
							<td class='pull-left'>Rp. $gaji</td>
							<td>$record[persentasi]%</td>";?>
							<!-- <td>
								<a data-toggle="modal" data-target="#<?=$record['nik']?>">
									<div class="form-group">
										<img width="20px" src="img/info-circle.svg">
									</div>
								</a>
							</td> -->
						<?php echo "</tr>
						";
						$no++;

					}
				?>
			</table>
		</div>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>

<?php $query=mysqli_query($con,"SELECT * from tbl_anggota");
while ($record = mysqli_fetch_array($query)) { 

				?>
	<div class="modal fade bd-example-modal-xl" id="<?=$record['nik']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-xl">
					    <div class="modal-content" style="padding: 20px;">
					    	<h5>
						    <span class="float-left"><?=$record["nik"]?>-<?=$record["nama"]?></span>
						</h5>
					        <center><img width="580px" src="img/dokumen/<?=$img?>"></center>
					        <div class="col-lg-12 row" style="background: white">
								<?php 
								$doky=mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_dokumen where nik='".$record['nik']."'"));
								$doc= array('KTP','KK','Ijazah','ATM');
								foreach ($doc as $dokumen ) { 
									$img = str_replace($record['nik'], "", $doky[$dokumen]);
									?>
									<div class="col-lg-3">
										<div class="col-lg-12">

													<h4><?=$dokumen?>
												</h4>

												<div class="form-group">
													<img width="200px" alt="<?=$img?>" src="img/dokumen/<?=$img?>">
												</div>
										</div>
									</div>
							<?php } ?>
								</div>
					    </div>
					  </div>
					</div>
<?php } ?>