<?php

include '../../auth/cek_login.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
b.*,
u.nama,
u.nim,
r.nama_ruang

FROM bookings b
JOIN users u ON b.id_user=u.id_user
JOIN rooms r ON b.id_room=r.id_room

WHERE b.id_booking='$id'
");

$data = mysqli_fetch_assoc($query);

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

<div class="card">

<div class="card-header">
<h3><i class="fas fa-times-circle"></i> Penolakan Pengajuan</h3>
</div>

<div class="card-body">

<div class="alert alert-warning">

<b>Mahasiswa</b> : <?= $data['nama']; ?><br>
<b>NIM</b> : <?= $data['nim']; ?><br>
<b>Ruangan</b> : <?= $data['nama_ruang']; ?><br>
<b>Kegiatan</b> : <?= $data['nama_kegiatan']; ?>

</div>

<form action="proses_reject.php" method="POST">

<input type="hidden" name="id_booking" value="<?= $data['id_booking']; ?>">

<div class="form-group">

<label>Keterangan</label>

<select
name="pilihan"
id="pilihan"
class="form-control"
required
onchange="ubahKeterangan()">

<option value="" disabled selected>
-- Pilih Keterangan --
</option>

<option value="Ruangan sedang maintenance.">
Ruangan sedang maintenance.
</option>

<option value="Ruangan digunakan untuk kegiatan fakultas.">
Ruangan digunakan untuk kegiatan fakultas.
</option>

<option value="Data pengajuan belum lengkap.">
Data pengajuan belum lengkap.
</option>

<option value="Jadwal kegiatan berbenturan dengan agenda kampus.">
Jadwal kegiatan berbenturan dengan agenda kampus.
</option>

<option value="lainnya">
Lainnya...
</option>

</select>

</div>

<div class="form-group">

<textarea
id="keterangan"
name="keterangan"
rows="5"
class="form-control"
readonly
required
placeholder="Pilih keterangan di atas atau pilih Lainnya"></textarea>

</div>

<button type="submit" class="btn btn-danger">
<i class="fas fa-times"></i> Tolak Pengajuan
</button>

<a href="detail.php?id=<?= $data['id_booking']; ?>" class="btn btn-secondary">
Batal
</a>

</form>

</div>

</div>

</div>

</section>

</div>

<script>

function ubahKeterangan() {

    let pilih = document.getElementById("pilihan");
    let txt = document.getElementById("keterangan");

    if (pilih.value === "lainnya") {

        txt.value = "";
        txt.readOnly = false;
        txt.focus();

    } else {

        txt.value = pilih.value;
        txt.readOnly = true;

    }

}

</script>

<?php

include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';

?>