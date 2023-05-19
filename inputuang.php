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

include 'koneksidb.php';
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("d-m-y",time());

$penghasilan_total = mysqli_query($conn, "SELECT sum(jumlah) FROM `pemasukan` WHERE `status`='masuk'
AND `petugas`='$_SESSION[username]'");
$data_penghasilan_total = mysqli_fetch_assoc($penghasilan_total);
$hasil_penghasilan_total = $data_penghasilan_total['sum(jumlah)'];


$query = "SELECT * FROM `neraca` ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$total = $data['total'];

$hasil = $total + $hasil_penghasilan_total;   //todo


if (isset($_POST["submit"])) {

    //buat dan jalankan query INSERT
    $query = "UPDATE `pemasukan` SET `status`='disimpan'";
    $result = mysqli_query($conn, $query);  

    //periksa hasil query
    if($result) {
      $query2 = "INSERT INTO `neraca`(`nominal`, `tanggal`, `total`) 
      VALUES ('$hasil_penghasilan_total','$tanggal','$hasil')";
      $result2 = mysqli_query($conn, $query2); 
      header("Location: uangditerima.php");
    }
    else {

    }
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

<body class="sb-nav-fixed">
<?php
require ('header.php');
require ('sidenav1.php');
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Tarik Jimpitan</h1>


<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Penarikan Jimpitan Warga</h6>
     
            
            <div class="mt-5 d-flex justify-content-end ">
                 <a href="tambahuang.php" class="btn btn-success me-3">Tarik Uang</a>
            </div>
            </div>
            <div class="card-body">
              
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
</thead>


                <?php
                $date= date("Y-m-d", time());
                $query = "SELECT * FROM `pemasukan` WHERE 
                 `status`='masuk' AND `petugas`='$_SESSION[username]' ORDER BY 
                `id` DESC";
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
                        <td>
                        <a href="edituang_petugas.php?id=<?php echo $data['id']; ?>" 
                        class="btn btn-sm btn-primary">Update</a>
                        <a href="proses_hapusuangpetugas.php?id=<?php echo $data['id']; ?>" 
                        class="btn btn-sm btn-danger alert_notif">Hapus</a>
                        </td>
        </tr>
            <?php
            }
            ?>
           
              
              
          </tbody>
</table>
<td>Total Uang Yang Ditarik <strong>Rp.<?php echo $hasil_penghasilan_total ?></strong></td>


</div>










<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
        <!-- jangan lupa menambahkan script js sweet alert di bawah ini  -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="main/dataTables/datatables.min.js"></script>
        <script src="assets/dataTables/css/dataTables.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js">
           <!-- Swal -->
	
</script>

<script>
<?php if(@$_SESSION['sukses']){ ?>
            <script>
                Swal.fire({            
                    icon: 'success',                   
                    title: 'Sukses',    
                    text: 'data berhasil dihapus',                        
                    timer: 3000,                                
                    showConfirmButton: false
                })
            </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['sukses']); } ?>
    
        </script>


        <!-- di bawah ini adalah script untuk konfirmasi hapus data dengan sweet alert  -->
        <script>
            $('.alert_notif').on('click',function(){
                var getLink = $(this).attr('href');
                Swal.fire({
                    title: "Yakin hapus data?",            
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: "Batal"
                
                }).then(result => {
                    //jika klik ya maka arahkan ke proses.php
                    if(result.isConfirmed){
                        window.location.href = getLink
                    }
                })
                return false;
            });
</script>
</body>
</main>


<?php
require ('footer.php');
?>
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
           <!-- Swal -->
           <script type="text/javascript"> $(document).ready
           ( function () {$('#dataTable').dataTable();} );</script>
</html>