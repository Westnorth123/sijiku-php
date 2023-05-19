<?php

$data = $_GET['id'];

//gunakan fungsi di bawah ini agar session bisa dibuat
session_start();

//koneksi ke database latihan
$koneksi = mysqli_connect("localhost", "root", "", "jimpitan1");

//hapus data dari tabel kontak
$delete = mysqli_query($koneksi, "delete from petugas where id=".$data);




//$query = "SELECT * FROM `login` INNER JOIN `petugas` ON (`login`.`username`=`petugas`.
//`username`) WHERE `login`.`level`='petugas'";
//result = mysqli_query($conn, $query);
//$no = 1;

//"delete from warga where id=".$data

//set session sukses
$_SESSION["sukses"] = 'Data Berhasil Dihapus';

//redirect ke halaman index.php
header('Location: petugas.php');  