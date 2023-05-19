<?php

$data = $_GET['id'];

//gunakan fungsi di bawah ini agar session bisa dibuat
session_start();

//koneksi ke database latihan
$koneksi = mysqli_connect("localhost", "root", "", "jimpitan1");

//hapus data dari tabel kontak
$delete = mysqli_query($koneksi, "delete from pemasukan where id=".$data);

//set session sukses
$_SESSION["sukses"] = 'Data Berhasil Dihapus';

//redirect ke halaman index.php
header('Location: uangmasuk1.php');  