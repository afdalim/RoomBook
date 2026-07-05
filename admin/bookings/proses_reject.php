<?php

session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

/* ==========================
   Ambil Data
========================== */

$idBooking  = $_POST['id_booking'];
$keterangan = trim($_POST['keterangan']);

/* ==========================
   Validasi
========================== */

if (empty($keterangan)) {

    echo "
    <script>
        alert('Silakan isi Keterangan terlebih dahulu.');
        history.back();
    </script>
    ";

    exit;
}

/* ==========================
   Amankan Input
========================== */

$keterangan = mysqli_real_escape_string($conn, $keterangan);

$idAdmin = $_SESSION['id_user'];

/* ==========================
   Update Database
========================== */

$update = mysqli_query($conn, "
UPDATE bookings
SET
    status = 'Rejected',
    alasan_penolakan = '$keterangan',
    approved_by = '$idAdmin',
    approved_at = NOW()
WHERE id_booking = '$idBooking'
");

/* ==========================
   Hasil
========================== */

if ($update) {

    echo "
    <script>
        alert('Pengajuan berhasil ditolak.');
        window.location='index.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Terjadi kesalahan, data gagal diperbarui.');
        history.back();
    </script>
    ";

}