<?php
 

 date_default_timezone_set("Asia/Jakarta");

 $tanggal = date("Y-m-d",time());

 


include "koneksidb.php";
$id = $_POST['id'];
$nama_warga = $_POST['nama_warga'];
$tanggal = $_POST['tanggal'];
$petugas = $_POST['petugas'];
$jumlah = $_POST['jumlah'];
$status = $_POST['status'];




$query=mysqli_query($conn, "UPDATE pemasukan SET nama_warga='$nama_warga', tanggal='$tanggal', 
petugas='$petugas', jumlah='500' ,status='masuk' WHERE id='$id'");




if($query) {
    echo "<script>alert('Berhasil membayar kekurangan!');window.location='uangmasuk1.php';</script>";
} else {
    echo "<script>alert('Gagal membayar kekurangan');</script>";
}
?>