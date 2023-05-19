<?php
	session_start();

  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="bendahara") {
      echo "Anda tidak punya akses pada halaman admin";
      exit;
  }

include 'koneksidb.php';



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Jimpitan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>

<body class="sb-nav-fixed">

<?php
require ('header.php');
require ('sidenav.php');
?>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Warga</h1>



<div class="center">
<body>


<?php

          
// membuat koneksi ke database 
$koneksi = mysqli_connect("localhost", "root", "", "jimpitan1");

//membuat variabel angka
$no = 1;
$id = $_GET['id']; 
$data = mysqli_query($koneksi,"select * from pemasukan where id='$id'");
$d = mysqli_fetch_array($data);

//mengambil data dari tabel post


//melooping(perulangan) dengan menggunakan while
{
?>





<div class="card shadow mb-4">
           
            <div class="card-body">
              <div class="table-responsive">

<form action="proses_edituang.php" method="POST">
		
					
     <label for="nama_warga" class="form-group">Nama Warga</label>
					    <input  type="hidden" name="id" value="<?php echo $d['id']; ?>">
						<input type="nama_warga" name="nama_warga" class="form-control" readonly value="<?php echo $d['nama_warga']; ?>">
					
					<label class="form-group">Tanggal</label>
						<input type="date" name="tanggal" class="form-control" value="<?php echo $d['tanggal']; ?>" >
						
						<label class="form-group">Petugas</label>
						<input type="petugas" name="petugas" class="form-control" readonly value="<?php echo $d['petugas']; ?>" >

                        <label class="form-group">Nominal</label>
						<input type="jumlah" name="jumlah" class="form-control" value="<?php echo $d['jumlah']; ?>" >

						
					
						

                        <div class="mt-3">
                        <button name="submit" class="btn btn-success" type="submit">Update</button>
                        </div>

				</form>
                <?php } ?>
			</div>
		</div>
		