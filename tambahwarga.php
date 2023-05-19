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

if (isset($_POST["submit"])) {

    $nama_warga           = htmlentities(strip_tags(trim($_POST["nama_warga"] ?? '')));
    $alamat               = htmlentities(strip_tags(trim($_POST["alamat"] ?? '')));
    $nomor_hp             = htmlentities(strip_tags(trim($_POST["nomor_hp"] ?? '')));
  
    $pesan_error="";

    if (empty($nama_warga)) {
      $pesan_error .= "Username belum diisi <br>";
    }
  
    $nama_warga = mysqli_real_escape_string($conn,$nama_warga);
    $query = "SELECT * FROM `warga` WHERE `nama_warga`='$nama_warga'";
    $hasil_query = mysqli_query($conn, $query);
  
  
    $jumlah_data = mysqli_num_rows($hasil_query);
     if ($jumlah_data >= 1 ) {
       $pesan_error .= "Nama Warga yang sama sudah digunakan <br>";
    }
    // jika tidak ada error, input ke database
    if ($pesan_error === "") {
  
      // filter semua data
      $nama_warga             = mysqli_real_escape_string($conn,$nama_warga);
      $alamat                 = mysqli_real_escape_string($conn,$alamat);
      $nomor_hp               = mysqli_real_escape_string($conn,$nomor_hp);
        
      //buat dan jalankan query INSERT
      $query = "INSERT INTO `warga`(`nama_warga`, `alamat_warga`, `nomor_hp`) 
      VALUES ('$nama_warga','$alamat','$nomor_hp')";
  
      $result = mysqli_query($conn, $query);  
  
      //periksa hasil query
      if($result) {
        header("Location: warga.php");
      }
      else {
  
      }
    }
    
  }
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
    $pesan_error            = "";
    $nama_warga             = "";
    $alamat                 = "";
    $nomor_hp               = "";
  }

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



<div class="card shadow mb-4"> 
           <div class="card-body">
<div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Warga</h1>

<form action="" method="post">
            <div>
                <label for="name" class="form-label">Nama Warga</label>
                <input type="text" name="nama_warga" class="form-control" placeholder="Nama Warga">
                <label for="name" class="form-label">Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" placeholder="089999">
                <label for="name" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Klaten">
            </div>

            <div class="mt-3">
                <button name="submit" class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
</div>

</div>
</div>










<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js">
</script>
</body>
</main>


<?php
require ('footer.php');
?>

</html>