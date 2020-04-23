<?php include 'belakang/connect.php';

  if (isset($_POST['simpan'])) {

      // $a=$_FILES['photo']['name'];
    $KTP=$_FILES['KTP']['name'];
    $KK=$_FILES['KK']['name'];
    $Ijazah=$_FILES['Ijazah']['name'];
    $ATM=$_FILES['ATM']['name'];
    $query="INSERT INTO tbl_anggota values ('".$_POST['NIK']."','".$_POST['Nama']."','".$_POST['Alamat']."','".$_POST['Pekerjaan']."','".$_POST['Gaji']."','0')";
      $sql=mysqli_query($con,$query);
          
    if ($sql) {

      if (is_uploaded_file($_FILES['KTP']['tmp_name'])) {
              move_uploaded_file($_FILES['KTP']['tmp_name'], "img/dokumen/".$_POST['NIK'].$KTP);
              //$img=",KTP='".$a."'";
            }
          if (is_uploaded_file($_FILES['KK']['tmp_name'])) {
              move_uploaded_file($_FILES['KK']['tmp_name'], "img/dokumen/".$_POST['NIK'].$KK);
              //$img=",KK='".$a."'";
            }
          if (is_uploaded_file($_FILES['Ijazah']['tmp_name'])) {
              move_uploaded_file($_FILES['Ijazah']['tmp_name'], "img/dokumen/".$_POST['NIK'].$Ijazah);
              //$img=",Ijazah='".$a."'";
            }
          if (is_uploaded_file($_FILES['ATM']['tmp_name'])) {
              move_uploaded_file($_FILES['ATM']['tmp_name'], "img/dokumen/".$_POST['NIK'].$ATM);
              //$img=",ATM='".$a."'";
            }


      $doc="INSERT INTO tbl_dokumen values ('".$_POST['NIK']."','".$_POST['NIK'].$KTP."','".$_POST['NIK'].$KK."','".$_POST['NIK'].$Ijazah."','".$_POST['NIK'].$ATM."')";
      mysqli_query($con,$doc);
      $inputuser="INSERT INTO tbl_user values (null,'".$_POST['NIK']."','".md5($_POST['NIK'])."','ANGGOTA')";
      mysqli_query($con,$inputuser);
      //echo $inputuser;
      echo "<script>alert('Data berhasil ditambah!');window.location.href='login.php'</script>";
    }else{
    echo "<script>alert('Penambahan data gagal!');window.location.href='index.php'</script>";
    // echo $query; echo $doc; echo $inputuser;
    }
  }
 ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title> Patogu Nuansa Baru</title>
  
  <link rel="icon" type="image/png" sizes="32x32" href="img/koperasi.png">
    <link rel="stylesheet" href="css/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="http://puldapii.com/id/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="bg">
<div class="container">
  <form method="POST" enctype="multipart/form-data">  
    <center>
      <img src="img/koperasi.png" width="150px">
    <h2>Registrasi Calon Nasabah <br> <small><span style="color: #00913F">Patogu Nuansa Baru</span><span style="color:#CFEA7F"> Bekasi</span></small></h2>
    <br><br>
  </center>

    <div class="row">
    </div>

     <div class="">
      <h4>Data Diri</h4>
      <div class="form-group">
        <label>NIK</label>
        <input type="text" name="NIK" class="form-control" minlength="16" maxlength="16"  value="<?=$_POST['NIK']?>" required>
      </div>

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="Nama" class="form-control" value="<?=$_POST['Nama']?>" required>
      </div>

      <div class="form-group">
        <label>Gaji Perbulan</label>
        <input type="number" name="Gaji" class="form-control" value="<?=$_POST['Gaji']?>" required>
      </div>
      <div class="form-group">
        <label>Pekerjaan</label>
        <select name="Pekerjaan" required class="form-control" style="text-align: left;">
                  <option selected disabled>Pilih Pekerjaan</option>
                  <?php
                    $query = mysqli_query($con,"SELECT * FROM tbl_pekerjaan order by nama_pekerjaan");
                    while($record = mysqli_fetch_array($query)){
                      echo "<option value='$record[id_pekerjaan]'>$record[nama_pekerjaan]</option>";
                    }
                  ?>
                </select>
      </div>
      <br>
      <div class="form-group">
        <label>Alamat</label>
        <textarea required name="Alamat" class="form-control"><?=$_POST['Alamat']?></textarea>
      </div>

      <!-- <div class="form-group">
       <h4>Jenis Kelamin</h4>
        <input type="radio" name="jk" value="laki" id="jenis-kelamin-laki" checked="true"/>
        <label for="jenis-kelamin-laki"><span><i class="fa fa-mars"></i>Laki-Laki</span></label>
        <input type="radio" name="jk" value="perempuan" id="jenis-kelamin-perempuan"/>
        <label for="jenis-kelamin-perempuan"> <span><i class="fa fa-venus"></i>Perempuan</span></label>
      </div> -->
    </div>

    <div class="">
      <h4>Dokumen</h4>
      <div class="form-group">
          <label>KTP</label>
          <input required type="file" accept="image/*" name="KTP" class="form-control input-lg">
      </div>
      <div class="form-group">
          <label>KK</label>
          <input required type="file" accept="image/*" name="KK" class="form-control input-lg">
      </div>
      <div class="form-group">
          <label>Ijazah</label>
          <input required type="file" accept="image/*" name="Ijazah" class="form-control input-lg">
      </div>
      <div class="form-group">
          <label>Kartu ATM (Tampak Depan)</label>
          <input required type="file" accept="image/*" name="ATM" class="form-control input-lg">
      </div>

    </div>
    <!-- CHECK UNTUK PERSYARATAN -->
    <div class="">
      <h4>Komitmen</h4>
      <div class="form-group">
        <input type="checkbox" id="terms" required />
        <label for="terms">Dengan ini saya bersedia bertanggung jawab atas data berikut.</label>
      </div>
    </div>
    <!-- BUTTON KIRIM -->
      <div class="">
      <button type="submit" class="btn btn--stripe btn--large" name="simpan" value="Submit" >Simpan</button>
    </div>
  </form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  



</body>

</html>