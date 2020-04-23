		<h4>Dokumen</h4>
			<div class="col-lg-12 row" style="background: white">
			<?php 
			$doky=mysqli_fetch_array(mysqli_query($con,"SELECT * from tbl_dokumen where nik='".$anggota['nik']."'"));
			$doc= array('KTP','KK','Ijazah','ATM');
			foreach ($doc as $dokumen ) { 
				// $img = str_replace($anggota['nik'], "", $doky[$dokumen]);
				$img=$anggota['nik'].$doky[$dokumen];
				?>
				<div class="col-lg-3">
					<div class="col-lg-12">

								<h4><?=$dokumen?>
								<!-- <small>
							    <span class="pull-right" ><a style="text-decoration: underline;color: #aaa" data-toggle="modal" class="btn btn-link" data-target="#edit<?=$dokumen?>">Edit <?=$dokumen?></a></span></small> -->
							</h4>

							<!-- Button trigger modal -->
						<a data-toggle="modal" data-target="#<?=$dokumen?>">
							<div class="form-group">
								
								<img width="200px" alt="<?=$img?>" src="img/dokumen/<?=$img?>">
							</div>
						</a>
					</div>
				</div>
					      <!-- <div class="modal-body">

						    <span class="float-right"><?=$record["nik"]?>-<?=$record["nama"]?></span>
					        <center><img width="400px" src="img/dokumen/<?=$img?>"></center>	
					      </div> -->

					<div class="modal fade bd-example-modal-xl" id="<?=$dokumen?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-xl">
					    <div class="modal-content" style="padding: 20px;">
					    	<h5>
						    <span class="float-left"><?=$anggota["nik"]?>-<?=$anggota["nama"]?></span>
						</h5>
					        <center><img width="580px" src="img/dokumen/<?=$img?>"></center>
					    </div>
					  </div>
					</div>

					<div class="modal fade" id="edit<?=$dokumen?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  					<form method="POST" enctype="multipart/form-data"> 
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Form edit <?=$dokumen?></h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <div class="form-group">
						          <label><?=$dokumen?></label>
						          <input required type="file" accept="image/*" name="<?=$dokumen?>" class="form-control input-lg">
						      </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button  type="submit" name="submit" class="btn btn-primary">Save changes</button>
					      </div>
					    </div>
					  </div>
					</form>
					</div>

					<!-- <div class="modal fade bd-example-modal-sm" id="edit<?=$dokumen?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					    	
  							<form method="POST" enctype="multipart/form-data"> 
					    	<div class="form-group">
						          <label><?=$dokumen?></label>
						          <input required type="file" accept="image/*" name="<?=$dokumen?>" class="form-control input-lg">
						      </div>
					    	</form>
					    </div>
					  </div>
					</div> -->
					
			<?php } ?>
			<p style="color: red">
		*) Kelengkapan dan keabsahan dokumen menjadi pertimbangan serius untuk perihal pengajuan.</p>
		</div>