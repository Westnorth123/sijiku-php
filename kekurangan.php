<?php
	session_start();

  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="bendahara") {
      echo "Anda tidak punya akses pada halaman petugas";
      exit;
  }

include 'koneksidb.php';
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
      VALUES ('$nama_warga','$tanggal','$_SESSION[username]','500','masuk')";
  
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
require ('header2.php');
require ('sidenav2.php');
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Kekurangan Warga</h1>
                        <form method="post">
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Histori</h6>
            </div>
           

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



            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Petugas</th>
                    <th style="text-align: center;">Nominal</th>
                    <th style="text-align: center;">Aksi</th>
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
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['nama_warga'] ?></td>
            <td><?php echo $data['tanggal'] ?></td>
            <td><?php echo $data['petugas'] ?></td>
            <td style ="color:#FF0000"><strong>Rp.500</strong></td>
            <td>
            
                        <a href="bayar_kekurangan.php?id= <?php echo $data['id'];?>" 
                        class="btn btn-sm btn-success">Bayar</a>
                        </td>
        </tr>
       
        
        <?php
            }
        ?>

              </tbody>
              
</table>

        </form>

</body>



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