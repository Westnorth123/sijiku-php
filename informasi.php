
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Pengelolaan Dana Jimpitan</title>
    <!-- core CSS -->
    <link href="main/css/bootstrap.min.css" rel="stylesheet">
    <link href="main/dataTables/datatables.min.css" rel="stylesheet"/>
    <link href="main/css/font-awesome.min.css" rel="stylesheet">
    <link href="main/css/animate.min.css" rel="stylesheet">
    <link href="main/css/owl.carousel.css" rel="stylesheet">
    <link href="main/css/owl.transitions.css" rel="stylesheet">
    <link href="main/css/prettyPhoto.css" rel="stylesheet">
    <link href="main/css/main.css" rel="stylesheet">
    <link href="main/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <script type="text/javascript" src="assets/DataTables/media/js/jquery.js"></script>
	<script type="text/javascript" src="assets/DataTables/media/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/dataTables.bootstrap.css">
  

    
       
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
       
  <!-- Custom styles for this template-->
 
</head>
<!--/head-->

<body id="home" class="homepage">
   
    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="main/img/logo-klaten.png" width="150" height="65" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right ">
                    <ul class="nav navbar-nav">
                    <li class="scroll"><a href="index.php">Beranda</a></li>
                        <li class="scroll"><a href="jadwal.php">Jadwal & Prosedur</a></li>
                        <li class="scroll active"><a href="informasi.php">Informasi</a></li>
                        <li class="scroll "><a href="user_check.php">LOGIN</a></li>
                    </ul>
                </div>
            </div>
            <!--/.container-->
        </nav>
        <!--/nav-->
    </header>
    <!--/header-->


<?php


  

include 'koneksidb.php';

$penghasilan_total = mysqli_query($conn, "SELECT sum(jumlah) FROM `pemasukan` WHERE `status`='disimpan'");
$data_penghasilan_total = mysqli_fetch_assoc($penghasilan_total);
$hasil_penghasilan_total = $data_penghasilan_total['sum(jumlah)'];

$pengeluaran_total = mysqli_query($conn, "SELECT sum(pengeluaran) FROM `pengeluaran`");
  $data_pengeluaran_total = mysqli_fetch_assoc($pengeluaran_total);
  $hasil_pengeluaran_total = $data_pengeluaran_total['sum(pengeluaran)'];
?>


<body class="sb-nav-fixed">

<div id="layoutSidenav_content">
<main>
<section id="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Informasi Keuangan</h2>
            </div>
            
            
<div class="card shadow mb-4">
           <div class="card-body">
             <div class="table-responsive">

                    <h1 class="mt-4">Uang Diterima</h1>

 

<div class="card shadow mb-4">
            <div class="card-header py-3">
             
              <td>Jumlah Total Uang Diterima <strong>Rp.<?php echo $hasil_penghasilan_total ?></strong></td>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Nama Warga</th>
            <th style="text-align: center;">Tanggal</th>
            <th style="text-align: center;">Petugas</th>
            <th style="text-align: center;">Jumlah</th>
        </tr>

</thead>
   
    <tbody>
        <?php
    $query = "SELECT * FROM `pemasukan` WHERE `status`='disimpan' ORDER BY `id` DESC";
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
            <td style="text-align: center;"><?php echo $no++ ?></td>
            <td><?php echo $data['nama_warga'] ?></td>
            <td><?php echo $data['tanggal'] ?></td>
            <td><?php echo $data['petugas'] ?></td>
            <td>Rp.<?php echo $data['jumlah'] ?></td>
        </tr>
        <?php
            }
            ?>
            
    </tbody>
</table>



       
           

          <!-- Filter Tanggal
           <form method="post">
            <div class="container-fluid py-4">
              <tr>
                <td>Cari Berdasarakan Tanggal</td>
                <td>
                  <input type="date" name="tgl" required="required">
                </td> 
                <td>
                <input type="submit" class="btn btn-primary" name="filter" >
                </td>
              </tr>
            </div>
            </form>-->


            <h1 class="mt-4">Kekurangan Warga</h1>
<div class="card shadow mb-4">
          
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                 
                  <thead>
                    <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Petugas</th>
                    <th style="text-align: center;">Nominal</th>
                  
                    </tr>
</thead>

<?php
    $query = "SELECT * FROM `pemasukan` WHERE `jumlah`='0' ORDER BY `id` DESC";
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
            <td style="text-align: center;"><?php echo $no++ ?></td>
            <td><?php echo $data['nama_warga'] ?></td>
            <td><?php echo $data['tanggal'] ?></td>
            <td><?php echo $data['petugas'] ?></td>
            <td >Rp.500</td>
      
            
                   
        </tr>
       
        
        <?php
            }
        ?>

              </tbody>
              
</table>

</form>


<h1 class="mt-4">Pengeluaran</h1>
<div class="card shadow mb-4">
          
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                 
             
                  <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Nominal</th>
                        
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                      $query = "SELECT * FROM `pengeluaran` ORDER BY `id` DESC";
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
                        <th style="text-align: center;"><?php echo $no++ ?></th>
                        <th><?php echo $data['nama'] ?></th>
                        <th><?php echo $data['tanggal'] ?></th>
                        <th>Rp.<?php echo $data['pengeluaran'] ?></th>
                       
                    </tr>

                    <?php
                  }
                  ?>
                                    </tbody>

</table>
</form>

<?php
	
include 'koneksidb.php';
date_default_timezone_set("Asia/Jakarta");

$query = "SELECT * FROM `neraca` ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];

?>


<h1 class="mt-4">Laporan Keuangan</h1>
<div class="card shadow mb-4">
            <div class="card-header py-3">
            
              <td>Jumlah Total Pengeluaran <strong>Rp.<?php echo $total ?></strong></td>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Keterangan</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Debit</th>
                        <th style="text-align: center;">Kredit</th>
                        <th style="text-align: center;">Saldo</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $query = "SELECT * FROM `neraca` ORDER BY `id` DESC";
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
                        <th style="text-align: center;"><?php echo $no++ ?></th>
                        <th><?php echo $data['keterangan'] ?></th>
                        <th><?php echo $data['tanggal'] ?></th>
                        <th><?php echo $data['debit'] ?></th>
                        <th><?php echo $data['kredit'] ?></th>
                        <th>Rp.<?php echo $data['total'] ?></th>
                        
                    </tr>
                    <?php
                    }
                    ?>
                </thead>
                </tbody>
</table>
</div>
</main>
</div>


    

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; <?php echo date('Y');?> Dusun Karangmojo 02/04, Mrisen, Juwiring, Klaten
                </div>
                <div class="col-sm-6">
                    <ul class="social-icons">
                       
                    <li><a href="https://www.instagram.com//" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="https://github.com/" target="_blank"><i class="fa fa-github"></i></a></li>                       
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

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

    <script type="text/javascript"> $(document).ready
    ( function () {$('#dataTable').dataTable();} );</script>

    <script type="text/javascript"> $(document).ready
    ( function () {$('#dataTable1').dataTable();} );</script>

    <script type="text/javascript"> $(document).ready
    ( function () {$('#dataTable2').dataTable();} );</script>
    
    <script type="text/javascript"> $(document).ready
    ( function () {$('#dataTable3').dataTable();} );</script>
    

</html>