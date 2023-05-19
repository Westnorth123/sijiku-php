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
        <link href="main/dataTables/datatables.min.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="main/dataTables/datatables.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script type="text/javascript" src="assets/DataTables/media/js/jquery.js"></script>
	<script type="text/javascript" src="assets/DataTables/media/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/dataTables.bootstrap.css">
    </head>

    </head>
<body class="sb-nav-fixed">
<?php
require ('header2.php');
require ('sidenav2.php');
?>
<div id="layoutSidenav_content">
<main>
    
<div class="container-fluid px-4">
                        <h1 class="mt-4">Neraca Keuangan</h1>

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tabel Neraca Keuangan</h6>
            <td>Jumlah Total Uang Saat ini <strong>Rp.<?php echo $total ?></strong  ></td>
            </div>
            <div class="card-body">
              <div class="table-responsive">
            



           <!--<form method="post">
            <div class="container-fluid py-4">
              <tr>
                <td>Cari Dari Tanggal</td>
                <td>
                  <input type="date" name="dari_tgl" required="required">
                </td> 
                <td>Sampai Tanggal</td>
                <td>
                  <input type="date" name="sampai_tgl" required="required">
                </td> 
                <td>
                <input type="submit" class="btn btn-primary" name="filter" >
                </td>
              </tr>
            </div>
            </form>-->





                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        
                    </tr>
</thead>




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
                        <th><?php echo $no++ ?></th>
                        <th><?php echo $data['keterangan'] ?></th>
                        <th><?php echo $data['tanggal'] ?></th>
                        <th><?php echo $data['debit'] ?></th>
                        <th><?php echo $data['kredit'] ?></th>
                        <th>Rp.<?php echo $data['total'] ?></th>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
</table>
</div>










<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
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
</script>
</body>
</main>


<?php
require ('footer.php');
?>

</html>