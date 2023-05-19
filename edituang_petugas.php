<?php
	session_start();

  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="petugas") {
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
require ('header1.php');
require ('sidenav1.php');
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

$query = mysqli_query($conn, "SELECT * FROM `warga`");
$namawarga = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST["submit"])) {

    $nama_warga           = htmlentities(strip_tags(trim($_POST["nama_warga"] ?? '')));
    $nominal               = htmlentities(strip_tags(trim($_POST["nominal"] ?? '')));
  
    $pesan_error="";

      // filter semua data
      $nama_warga           = mysqli_real_escape_string($conn,$nama_warga);
      $nominal              = mysqli_real_escape_string($conn,$nominal);
        
      //buat dan jalankan query INSERT
      $query = "INSERT INTO `pemasukan`(`nama_warga`, `tanggal`, `petugas`, `jumlah`, `status`) 
      VALUES ('$nama_warga','$tanggal','$_SESSION[username]','$nominal','masuk')";
  
      $result = mysqli_query($conn, $query);  
  
      //periksa hasil query
      if($result) {
        header("Location: inputuang.php");
      }
      else {
  
      }
    }
    
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
    $pesan_error            = "";
    $nama_warga             = "";
    $nominal                = "";
  }

//melooping(perulangan) dengan menggunakan while
{
?>





<div class="card shadow mb-4">
           
            <div class="card-body">
              <div class="table-responsive">

<form action="proses_edituangpetugas.php" method="POST">
		
					
     <label for="nama_warga" class="form-group">Nama Warga</label>
					    <input  type="hidden" name="id" value="<?php echo $d['id']; ?>">
						<select id="select2" class="form-control text-uppercase" name="nama_warga">
                            <?php foreach ($namawarga as $pilih) {
                                echo '<option name="'.$pilih['nama_warga'].'">'.$pilih['nama_warga'].'</option>';
                            } ?>
                      </select>
					
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
		