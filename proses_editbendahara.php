<?php
 
include "koneksidb.php";
$id = $_POST['id'];
$nama_bendahara = $_POST['nama_bendahara'];
$nomor_hp = $_POST['nomor_hp'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];





$query=mysqli_query($conn, "UPDATE bendahara SET nama_bendahara='$nama_bendahara', nomor_hp='$nomor_hp', 
username='$username',password='$password',level='bendahara' WHERE id='$id'");



if($query) {
    echo "<script>alert('Data berhasil diubah!');window.location='bendahara1.php';</script>";
} else {
    echo "<script>alert('Data gagal diubah');</script>";
}
?>