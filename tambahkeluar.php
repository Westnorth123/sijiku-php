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

$query = "SELECT * FROM `neraca` ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];

if (isset($_POST["submit"])) {

    $nama                   = htmlentities(strip_tags(trim($_POST["nama"] ?? '')));
    $tanggal                = htmlentities(strip_tags(trim($_POST["tanggal"] ?? '')));
    $jumlah                 = htmlentities(strip_tags(trim($_POST["jumlah"] ?? '')));
  

      // filter semua data
      $nama                 = mysqli_real_escape_string($conn,$nama);
      $tanggal              = mysqli_real_escape_string($conn,$tanggal);
      $jumlah               = mysqli_real_escape_string($conn,$jumlah);

      
      $sisa = $total-$jumlah;
        
      //buat dan jalankan query INSERT
      $query = "INSERT INTO `pengeluaran`(`nama`, `tanggal`, `pengeluaran`, `sisa`) VALUES ('$nama','$tanggal','$jumlah','$sisa')";
  
      $result = mysqli_query($conn, $query);  
  
      //periksa hasil query
      if($result) {
        $query2 = "INSERT INTO `pemasukan`(`nominal`, `tanggal`, `total`) VALUES (' - Pengeluaran','$tanggal','$sisa')";
        $result2 = mysqli_query($conn, $query2);
        header("Location: pengeluaran.php");
      }
      else {
  
      }
    }
    
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
    $nama                 = "";
    $tanggal              = "";
    $jumlah               = "";
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
<div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Pengeluaran</h1>



<div class="center">
<form method="post">
            <div>
                <label class="form-label">Nama Pengeluaran</label>
                <input name="nama" type="text" class="form-control" placeholder="Nama Pengeluaran" required>
                <label class="date">Tanggal</label>
                <input name="tanggal" type="date" class="form-control" placeholder="Tanggal" required>
                <label class="form-label">Jumlah</label>
                <input name="jumlah" type="text" class="form-control" placeholder="jumlah" required>
            </div>

            <div class="mt-3">
                <button name="submit" class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
</div>
<main>
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