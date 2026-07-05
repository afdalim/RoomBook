<?php

include '../../config/koneksi.php';

session_start();

if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin'){
    header("Location: ../../auth/login.php");
    exit;
}

$id = $_GET['id'];
$idAdmin = $_SESSION['id_user'];

// Membuat nomor surat otomatis
$nomorSurat = "RB/" . date("Y") . "/" . str_pad($id, 5, "0", STR_PAD_LEFT);

// Update status booking
mysqli_query($conn, "
UPDATE bookings
SET
    status = 'Approved',
    nomor_surat = '$nomorSurat',
    approved_by = '$idAdmin',
    approved_at = NOW()
WHERE id_booking = '$id'
");

// Kembali ke halaman booking
header("Location: index.php");
exit;

?>