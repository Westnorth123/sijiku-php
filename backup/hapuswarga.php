<?php

include 'koneksidb.php';


if (isset($_POST["bthapus"])) {

    $nama = htmlentities(strip_tags(trim($_POST["hapus"])));
  
    $nama = mysqli_real_escape_string($conn,$nama);
  
    $query = "DELETE FROM `warga` WHERE nama_warga='$nama' ";
    $hasil_query = mysqli_query($conn, $query);
  
    if($hasil_query) {

        header("Location: warga.php");
    }
    else {
      die ("Query gagal dijalankan: ".mysqli_errno($conn).
           " - ".mysqli_error($conn));
    }
  }
    
?>
