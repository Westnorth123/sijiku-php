<?php
	session_start();

  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="admin") {
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
                        <h1 class="mt-4">Edit Bendahara</h1>



<div class="center">
<body>


<?php

          
// membuat koneksi ke database 
$koneksi = mysqli_connect("localhost", "root", "", "jimpitan1");

//membuat variabel angka
$no = 1;
$id = $_GET['id']; 
$data = mysqli_query($koneksi,"select * from bendahara where id='$id'");
$d = mysqli_fetch_array($data);

//mengambil data dari tabel post


//melooping(perulangan) dengan menggunakan while
{
?>





<div class="card shadow mb-4">
           
            <div class="card-body">
              <div class="table-responsive">

<form action="proses_editbendahara.php" method="POST">
		
					
     <label for="nama_warga" class="form-group">Nama Bendahara</label>
					    <input  type="hidden" name="id" value="<?php echo $d['id']; ?>">
						<input type="nama_petugas" name="nama_bendahara" class="form-control"  value="<?php echo $d['nama_bendahara']; ?>">
					
                        <label class="form-group">Nomor HP</label>
						<input type="nomor_hp" name="nomor_hp" class="form-control" value="<?php echo $d['nomor_hp']; ?>" >

					<label class="form-group">Nomor HP</label>
						<input type="username" name="username" class="form-control" value="<?php echo $d['username']; ?>" >
						
						
					
					
						
                        <label class="form-group">Password</label>
						<input type="pass" name="password" class="form-control" value="<?php echo $d['password']; ?>" >
						<input  type="hidden" name="level" value="<?php echo $d['level']; ?>">

                        <div class="mt-3">
                        <button name="submit" class="btn btn-success" type="submit">Update</button>
                        
                        
                        </div>


				</form>
                <?php } ?>
			</div>
		</div>
		