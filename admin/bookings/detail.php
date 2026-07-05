<?php

include '../../auth/cek_login.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
SELECT
    b.*,
    u.nama,
    u.nim,
    u.prodi,
    r.nama_ruang,
    r.lokasi
FROM bookings b
JOIN users u ON b.id_user = u.id_user
JOIN rooms r ON b.id_room = r.id_room
WHERE b.id_booking = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan.");
}

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

<div class="card">

<div class="card-header">
    <h3><i class="fas fa-calendar-check"></i> Detail Pengajuan Peminjaman</h3>
</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
    <th width="250">Nama Mahasiswa</th>
    <td><?= $data['nama']; ?></td>
</tr>

<tr>
    <th>NIM</th>
    <td><?= $data['nim']; ?></td>
</tr>

<tr>
    <th>Program Studi</th>
    <td><?= $data['prodi']; ?></td>
</tr>

<tr>
    <th>Organisasi</th>
    <td><?= $data['organisasi']; ?></td>
</tr>

<tr>
    <th>Ruangan</th>
    <td><?= $data['nama_ruang']; ?></td>
</tr>

<tr>
    <th>Lokasi</th>
    <td><?= $data['lokasi']; ?></td>
</tr>

<tr>
    <th>Nama Kegiatan</th>
    <td><?= $data['nama_kegiatan']; ?></td>
</tr>

<tr>
    <th>Tanggal</th>
    <td><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
</tr>

<tr>
    <th>Jam</th>
    <td><?= date('H:i', strtotime($data['jam_mulai'])); ?> - <?= date('H:i', strtotime($data['jam_selesai'])); ?></td>
</tr>

<tr>
    <th>Jumlah Peserta</th>
    <td><?= $data['jumlah_peserta']; ?> Orang</td>
</tr>

<tr>
    <th>Keperluan</th>
    <td><?= nl2br($data['keperluan']); ?></td>
</tr>

<tr>
    <th>Status</th>
    <td>

        <?php

        if ($data['status'] == "Pending") {

            echo "<span class='badge badge-warning'>Pending</span>";

        } elseif ($data['status'] == "Approved") {

            echo "<span class='badge badge-success'>Approved</span>";

        } else {

            echo "<span class='badge badge-danger'>Rejected</span>";

        }

        ?>

    </td>
</tr>

<?php if ($data['status'] == "Approved") { ?>

<tr>
    <th>Disetujui Pada</th>
    <td><?= date('d-m-Y H:i', strtotime($data['approved_at'])); ?></td>
</tr>

<?php } ?>

<?php if ($data['status'] == "Rejected") { ?>

<tr>
    <th>Keterangan</th>
    <td>

        <?php

        if (!empty($data['alasan_penolakan'])) {

            echo nl2br($data['alasan_penolakan']);

        } else {

            echo "-";

        }

        ?>

    </td>
</tr>

<tr>
    <th>Ditolak Pada</th>
    <td><?= date('d-m-Y H:i', strtotime($data['approved_at'])); ?></td>
</tr>

<?php } ?>

</table>

<br>

<?php if ($data['status'] == "Pending") { ?>

<a href="approve.php?id=<?= $data['id_booking']; ?>" class="btn btn-success">
    <i class="fas fa-check"></i>
    Approve
</a>

<a href="reject.php?id=<?= $data['id_booking']; ?>" class="btn btn-danger">
    <i class="fas fa-times"></i>
    Reject
</a>

<?php } ?>

<a href="index.php" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>

</div>

</div>

</div>

</section>

</div>

<?php

include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';

?>