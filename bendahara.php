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

  $data_petugas = mysqli_query($conn,"SELECT * FROM `petugas` WHERE `level`='petugas'");
  $jumlah_petugas = mysqli_num_rows($data_petugas);

  $data_warga = mysqli_query($conn,"SELECT * FROM `warga`");
  $jumlah_warga = mysqli_num_rows($data_warga);

  $query = "SELECT * FROM `neraca` ORDER BY `id` DESC LIMIT 1";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($result);
  $total = $data['total'];

  $pengeluaran_total = mysqli_query($conn, "SELECT sum(pengeluaran) FROM `pengeluaran`");
  $data_pengeluaran_total = mysqli_fetch_assoc($pengeluaran_total);
  $hasil_pengeluaran_total = $data_pengeluaran_total['sum(pengeluaran)']; 

  date_default_timezone_set("Asia/Jakarta");

$query = "SELECT * FROM `neraca` ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];

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
require ('header2.php');
require ('sidenav2.php');
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
<div class="row">
                            
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
          </div>

          <!-- Content Row -->
          

             <!-- Content Row -->
             
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Petugas</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><href="petugas.php"><?php echo $jumlah_petugas ?> Petugas</a></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-user fa-2x text-gray-300"></i>
        </div>
      </div>
</div>
    
</div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Warga</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><href="warga.php"><?php echo $jumlah_warga ?> Warga</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
				
			
              </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Uang Sekarang</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><href="pemasukan.php">Rp.<?php echo $total ?></a></div>
                        </div>   
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>

                </div>
                        
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Pengeluaran</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <href="pengeluaran.php">Rp.<?php echo $hasil_pengeluaran_total ?></a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
</main>















<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js">
<script src="main/js/jquery.js"></script>
    <script src="main/js/bootstrap.min.js"></script>
    <script src="main/dataTables/datatables.min.js"></script>
    <script src="assets/dataTables/css/dataTables.min.css"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="main/js/owl.carousel.min.js"></script>
    <script src="main/js/mousescroll.js"></script>
    <script src="main/js/smoothscroll.js"></script>
    <script src="main/js/jquery.prettyPhoto.js"></script>
    <script src="main/js/jquery.isotope.min.js"></script>
    <script src="main/js/jquery.inview.min.js"></script>
    <script src="main/js/wow.min.js"></script>
    <script src="main/js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Swal -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
	<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
      </script>
</body>


<?php
require ('footer.php');
?>

</html>