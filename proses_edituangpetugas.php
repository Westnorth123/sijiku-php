<?php
 
include "koneksidb.php";
$id = $_POST['id'];
$nama_warga = $_POST['nama_warga'];
$tanggal = $_POST['tanggal'];
$petugas = $_POST['petugas'];
$jumlah = $_POST['jumlah'];
$status = $_POST['masuk'];




$query=mysqli_query($conn, "UPDATE pemasukan SET nama_warga='$nama_warga', tanggal='$tanggal', 
petugas='$petugas', jumlah='$jumlah',status='masuk' WHERE id='$id'");



if($query) {
    echo "<script>alert('Data berhasil diubah!');window.location='inputuang.php';</script>";
} else {
    echo "<script>alert('Data gagal diubah');</script>";
}
?>