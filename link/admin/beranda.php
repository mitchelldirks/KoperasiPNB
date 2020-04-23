<div class="main-dash">
	
	<!--- MAIN CONTENT HERE -->
	<div class="main-content">
		<div class="main-title"><h2>Dashboard</h2></div>
		<div class="content-small"><h3 class="content-title">Transaksi</h3>
			<span class="pull-right" style="font-size: 3em"><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from tbl_transaksi")); ?></span>
			<p class="mr-2 ml-2">Jumlah Transaksi yang telah dilakukan</p>
		</div>
		<div class="content-small"><h3 class="content-title">Pengajuan</h3>
			<span class="pull-right" style="font-size: 3em"><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from tbl_pengajuan")); ?></span>
			<p class="mr-2 ml-2">Jumlah Permohonan Pengajuan</p>
		</div>
		<div class="content-small"><h3 class="content-title">Angsuran</h3>
			<span class="pull-right" style="font-size: 3em"><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from tbl_detail_angsuran")); ?></span>
			<p class="mr-2 ml-2">Jumlah Angsuran Terbayarkan</p>
			<br>
			<span class="mr-2 ml-2" style="font-size: 2em"><?php 
			$angs = mysqli_fetch_array(mysqli_query($con,"SELECT sum(besar_angsuran) as masuk from tbl_detail_angsuran"));
			echo "Rp. ".number_format($angs["masuk"]); ?></span>
			<br>
			<p class="mr-2 ml-2">Jumlah Dana Angsuran Terbayarkan</p>
		</div>

		<div class="content-big">
			<h3 class="content-title">Jumlah pengajuan berdasarkan kategori</h3>
			<canvas id="myChart"></canvas>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<?php 
		// $sql="SELECT * from tbl_barang b join tbl_pengajuan p on p.barang=b.id_barang join tbl_transaksi t on t.pengajuan=p.id_pengajuan join tbl_kategori_barang k on k.id_kategori=b.kategori where p.status = '3'";
		//echo $sql;
		 ?>
		<script type="text/javascript">
		function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
                }
			var ctx = document.getElementById('myChart').getContext('2d');
			var chart = new Chart(ctx, {
			    // The type of chart we want to create
			    type: 'pie',

			    // The data for our dataset
			    data: {
			        // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],

			         labels: [
			         <?php 
			         $kategori="select * from tbl_kategori";
			         $k=mysqli_query($con,$kategori);
			         $row=0;
			         while ($kat=mysqli_fetch_array($k)) { 
			         	if ($row==0) {
			         		echo "'".$kat["kategori_barang"]."'";
			         	}else{
			         		echo ",'".$kat["kategori_barang"]."'";
			         	}
			         	$row++;
			         }
			          ?>
			         ],
			        datasets: [{
			            label: 'My First dataset',
			            backgroundColor: [<?php for ($i=0; $i <= $row; $i++) { 
			            	if ($i==0) { ?>
			            		getRandomColor()
				         	<?php }else{ ?> 
				         		, getRandomColor()
				         	<?php }
				         	$row++;
			            } ?>],
			            borderColor: getRandomColor(),
			            data: [0, 10, 5, 2, 20]
			        }]
			    },

			    // Configuration options go here
			    options: {}
			});
		</script>
		<div class="clear"></div>
	</div>
	<!--- END HERE -->
	
	<div class="clear"></div>
</div>