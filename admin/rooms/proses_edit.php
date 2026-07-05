<?php

include '../../config/koneksi.php';

$id=$_POST['id_room'];
$nama=$_POST['nama_ruang'];
$lokasi=$_POST['lokasi'];
$kapasitas=$_POST['kapasitas'];
$fasilitas=$_POST['fasilitas'];
$status=$_POST['status'];

mysqli_query($conn,"UPDATE rooms SET

nama_ruang='$nama',
lokasi='$lokasi',
kapasitas='$kapasitas',
fasilitas='$fasilitas',
status='$status'

WHERE id_room='$id'
");

header("Location:index.php");