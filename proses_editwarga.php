<?php
 
include "koneksidb.php";
$id = $_POST['id'];
$nama_warga = $_POST['nama_warga'];
$alamat_warga = $_POST['alamat_warga'];
$nomor_hp = $_POST['nomor_hp'];





$query=mysqli_query($conn, "UPDATE warga SET nama_warga='$nama_warga', alamat_warga='$alamat_warga', 
nomor_hp='$nomor_hp' WHERE id='$id'");



if($query) {
    echo "<script>alert('Data berhasil diubah!');window.location='warga.php';</script>";
} else {
    echo "<script>alert('Data gagal diubah');</script>";
}
?>