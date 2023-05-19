<?php
include("koneksi.php"); 
$id=$_GET['id'];
$query=mysqli_query($koneksi, "DELETE FROM uang_masuk WHERE id='".$id."'");

if($query) {
    echo "<script>alert('Data berhasil dihapus!');window.location='inputuang.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus');</script>";
}
?>



