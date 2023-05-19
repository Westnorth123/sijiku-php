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
require ('sidenav.php');
?>
<div id="layoutSidenav_content">
<main>

<div class="container-fluid px-4">
                        <h1 class="mt-4">Bendahara</h1>


<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Bendahara</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Nomor HP</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Aksi</th>

    </tr>
    <?php
            // membuat koneksi ke database 
            $koneksi = mysqli_connect("localhost", "root", "", "jimpitan1");

            //membuat variabel angka
            $no = 1;

            //mengambil data dari tabel post
            $select         = mysqli_query($koneksi, "select * from bendahara");

            //melooping(perulangan) dengan menggunakan while
            while($data= mysqli_fetch_array($select)){
              ?>

    <!--SELECT * FROM `login` INNER JOIN `petugas` ON (`login`.`username`=`petugas`.`username`) WHERE `login`.`username`='$_SESSIONS[username]'-->
    <tr>
      <td scope="col"><?php echo $no++ ?></td>
      <td scope="col"><?php echo $data['nama_bendahara'] ?></td>
      <td scope="col"><?php echo $data['nomor_hp'] ?></td>
      <td scope="col"><?php echo $data['username'] ?></td>
      <td scope="col"><?php echo $data['password'] ?></td>
      <td>
         <a href="editbendahara.php?id=<?php echo $data['id']; ?>" 
         class="btn btn-sm btn-primary">Update</a>
      </td>
    </tr>

    <?php
            }
    ?>
  </thead>
  <tbody>
    
  </tbody>
</table>

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