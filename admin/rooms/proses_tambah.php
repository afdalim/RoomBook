<?php

include '../../config/koneksi.php';

$nama=$_POST['nama_ruang'];
$lokasi=$_POST['lokasi'];
$kapasitas=$_POST['kapasitas'];
$fasilitas=$_POST['fasilitas'];
$status=$_POST['status'];

mysqli_query($conn,"INSERT INTO rooms
(nama_ruang,lokasi,kapasitas,fasilitas,status)

VALUES

('$nama','$lokasi','$kapasitas','$fasilitas','$status')");

header("Location:index.php");