<?php

include '../../config/koneksi.php';

$id_user    = $_POST['id_user'];
$id_room    = $_POST['id_room'];
$organisasi = trim($_POST['organisasi']);
$nama       = trim($_POST['nama_kegiatan']);
$tanggal    = $_POST['tanggal'];
$mulai      = $_POST['jam_mulai'];
$selesai    = $_POST['jam_selesai'];
$peserta    = $_POST['jumlah_peserta'];
$keperluan  = trim($_POST['keperluan']);

/* ===========================
   VALIDASI TANGGAL
=========================== */

if ($tanggal < date("Y-m-d")) {

    echo "
    <script>
    alert('Tanggal peminjaman tidak boleh kurang dari hari ini.');
    history.back();
    </script>";
    exit;
}

/* ===========================
   VALIDASI JAM
=========================== */

if (strtotime($selesai) <= strtotime($mulai)) {

    echo "
    <script>
    alert('Jam selesai harus lebih besar dari jam mulai.');
    history.back();
    </script>";
    exit;
}

/* ===========================
   VALIDASI KAPASITAS
=========================== */

$room = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT kapasitas
FROM rooms
WHERE id_room='$id_room'
"));

if ($peserta > $room['kapasitas']) {

    echo "
    <script>
    alert('Jumlah peserta melebihi kapasitas ruangan yaitu ".$room['kapasitas']." orang.');
    history.back();
    </script>";
    exit;
}

/* ===========================
   VALIDASI BENTROK JADWAL
=========================== */

$cek = mysqli_query($conn,"
SELECT
jam_mulai,
jam_selesai
FROM bookings
WHERE
id_room='$id_room'
AND tanggal='$tanggal'
AND status='Approved'
ORDER BY jam_mulai ASC
");

$booking = [];

while($row = mysqli_fetch_assoc($cek)){
    $booking[] = $row;
}

foreach($booking as $index => $jadwal){

    $mulaiLama   = strtotime($jadwal['jam_mulai']);
    $selesaiLama = strtotime($jadwal['jam_selesai']);

    $mulaiBaru   = strtotime($mulai);
    $selesaiBaru = strtotime($selesai);

    if(
        $mulaiBaru < $selesaiLama &&
        $selesaiBaru > $mulaiLama
    ){

        $jamMulai   = date("H:i",$mulaiLama);
        $jamSelesai = date("H:i",$selesaiLama);

        $pesan = "Ruangan sudah dibooking pada rentang waktu ".$jamMulai." - ".$jamSelesai.".";

        // Cek apakah masih ada booking berikutnya
        if(isset($booking[$index+1])){

            $nextMulai = date("H:i",strtotime($booking[$index+1]['jam_mulai']));
            $nextSelesai = date("H:i",strtotime($booking[$index+1]['jam_selesai']));

            $pesan .= "\n\nSaran Jadwal :";
            $pesan .= "\n".$jamSelesai." - ".$nextMulai;
            $pesan .= "\natau setelah ".$nextSelesai.".";

        }else{

            $pesan .= "\n\nSaran Jadwal :";
            $pesan .= "\nSetelah pukul ".$jamSelesai.".";

        }

        echo "
        <script>

        alert(".json_encode($pesan).");

        history.back();

        </script>
        ";

        exit;

    }

}

/* ===========================
   SIMPAN DATA
=========================== */

mysqli_query($conn,"
INSERT INTO bookings
(
id_user,
id_room,
organisasi,
nama_kegiatan,
tanggal,
jam_mulai,
jam_selesai,
jumlah_peserta,
keperluan,
status
)
VALUES
(
'$id_user',
'$id_room',
'$organisasi',
'$nama',
'$tanggal',
'$mulai',
'$selesai',
'$peserta',
'$keperluan',
'Pending'
)
");

echo "
<script>

alert('Pengajuan peminjaman berhasil dikirim dan menunggu persetujuan admin.');

window.location='../bookings/index.php';

</script>
";