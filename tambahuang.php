<?php
	session_start();

  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="petugas") {
      echo "Anda tidak punya akses pada halaman petugas";
      exit;
  }

include 'koneksidb.php';
date_default_timezone_set("Asia/Jakarta");

$tanggal = date("Y-m-d",time());

$query = mysqli_query($conn, "SELECT * FROM `warga`");
$namawarga = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST["submit"])) {

    $id_warga           = htmlentities(strip_tags(trim($_POST["id_warga"] ?? '')));
    $nama_warga           = htmlentities(strip_tags(trim($_POST["nama_warga"] ?? '')));
    $nominal               = htmlentities(strip_tags(trim($_POST["nominal"] ?? '')));
  
    $pesan_error="";

      // filter semua data
      $id_warga           = mysqli_real_escape_string($conn,$id_warga);
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        </head>

<body class="sb-nav-fixed">
<?php
require ('header.php');
require ('sidenav1.php');
?>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Input uang</h1>
<div class="card shadow mb-4">


<div class="center">
<form method="post">
<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <div class="field">
                <div class="field-body">
                  <div class="field">
                    <label class="label">Pilih Nama warga</label>
                      <div class="control">
                      <div class="form-group"> 
                      <select id="select2" class="form-control text-uppercase" name="nama_warga">
                            <?php foreach ($namawarga as $pilih) {
                                echo '<option name="'.$pilih['nama_warga'].'">'
                                .$pilih['nama_warga'].'</option>';
                            } ?>
                      </select>
                        </div>
                        </div>
                  </div>
              </div>
            </div>
            <div>
                <label for="name" class="form-label" >Nominal</label>
                <input type="text size-lg" name="nominal" class="form-control" 
                placeholder="NOMINAL (isikan 0 apabila kosong)" required>
            </div>
            </div>
            </div>

            <div class="mt-3">
                <button name="submit" class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>

        
</div>

<main>
</div>
</form>
</div>
</thead>
</table>

<div class="container-fluid px-4">
                        <h3 class="mt-3">Data Telah Diinput</h3>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                    </tr>
                
                <?php
                $date= date("Y-m-d", time());
                $query = "SELECT * FROM `pemasukan` WHERE `tanggal`='$date' AND `status`='masuk' ORDER BY `id` DESC";
                $result = mysqli_query($conn, $query);
                $no = 1;
            

          
            if(!$result){
                die ("Query Error: ".mysqli_errno($conn).
                     " - ".mysqli_error($conn));
            }

            while($data = mysqli_fetch_assoc($result))
            {
              ?>
          
            <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama_warga'] ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['jumlah'] ?></td>
            </tr>
           
              <?php
            }
              ?>
              
              
              </thead>
</table>



</div>











<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
              $(document).ready(function () {
              $('#select2').select2( {
              theme: 'bootstrap-5'
              });
            });
            
</script>
</body>

</html>