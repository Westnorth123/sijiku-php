<?php
 
include "koneksidb.php";
$id = $_POST['id'];
$nama_petugas = $_POST['nama_petugas'];
$nomor_hp = $_POST['nomor_hp'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];





$query=mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama_petugas', nomor_hp='$nomor_hp', 
username='$username',password='$password',level='petugas' WHERE id='$id'");



if($query) {
    echo "<script>alert('Data berhasil diubah!');window.location='petugas.php';</script>";
} else {
    echo "<script>alert('Data gagal diubah');</script>";
}
?>