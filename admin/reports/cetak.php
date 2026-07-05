<?php

include '../../auth/cek_login.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

/*
|--------------------------------------------------------------------------
| LOAD FPDF
|--------------------------------------------------------------------------
*/

$fpdf = '../../library/fpdf/fpdf.php';

if(!file_exists($fpdf)){
    die("FPDF tidak ditemukan.<br>Pastikan file berada di:<br>".$fpdf);
}

require_once($fpdf);

/* ===========================
   FILTER
=========================== */

$tanggalAwal = $_GET['tanggal_awal'];
$tanggalAkhir = $_GET['tanggal_akhir'];

/* ===========================
   DATA
=========================== */

$query = mysqli_query($conn,"
SELECT
b.*,
u.nama,
u.nim,
u.prodi,
r.nama_ruang

FROM bookings b

JOIN users u
ON b.id_user=u.id_user

JOIN rooms r
ON b.id_room=r.id_room

WHERE tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'

ORDER BY tanggal ASC,jam_mulai ASC
");

/* ===========================
   PDF
=========================== */

$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,8,'SEKOLAH TINGGI ILMU KOMPUTER YOS SUDARSO',0,1,'C');

$pdf->SetFont('Arial','',11);

$pdf->Cell(0,6,'Laporan Peminjaman Ruangan',0,1,'C');

$pdf->Cell(
0,
6,
'Periode : '.date('d-m-Y',strtotime($tanggalAwal)).' s/d '.date('d-m-Y',strtotime($tanggalAkhir)),
0,
1,
'C'
);

$pdf->Ln(5);

/* ===========================
   HEADER TABEL
=========================== */

$pdf->SetFont('Arial','B',9);

$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(35,8,'Tanggal',1,0,'C');
$pdf->Cell(45,8,'Mahasiswa',1,0,'C');
$pdf->Cell(25,8,'NIM',1,0,'C');
$pdf->Cell(35,8,'Ruangan',1,0,'C');
$pdf->Cell(55,8,'Kegiatan',1,0,'C');
$pdf->Cell(30,8,'Jam',1,0,'C');
$pdf->Cell(25,8,'Status',1,1,'C');

$pdf->SetFont('Arial','',9);

$no=1;

$total=0;
$approved=0;
$pending=0;
$rejected=0;

while($d=mysqli_fetch_assoc($query)){

    $total++;

    if($d['status']=="Approved"){
        $approved++;
    }elseif($d['status']=="Pending"){
        $pending++;
    }else{
        $rejected++;
    }

    $pdf->Cell(10,8,$no++,1,0,'C');

    $pdf->Cell(
        35,
        8,
        date('d-m-Y',strtotime($d['tanggal'])),
        1,
        0
    );

    $pdf->Cell(45,8,$d['nama'],1,0);

    $pdf->Cell(25,8,$d['nim'],1,0);

    $pdf->Cell(35,8,$d['nama_ruang'],1,0);

    $pdf->Cell(
        55,
        8,
        substr($d['nama_kegiatan'],0,28),
        1,
        0
    );

    $pdf->Cell(
        30,
        8,
        date('H:i',strtotime($d['jam_mulai'])).
        " - ".
        date('H:i',strtotime($d['jam_selesai'])),
        1,
        0
    );

    $pdf->Cell(
        25,
        8,
        $d['status'],
        1,
        1,
        'C'
    );

}

/* ===========================
   RINGKASAN
=========================== */

$pdf->Ln(8);

$pdf->SetFont('Arial','B',11);

$pdf->Cell(60,8,'Ringkasan Laporan',0,1);

$pdf->SetFont('Arial','',10);

$pdf->Cell(60,7,'Total Pengajuan : '.$total,0,1);

$pdf->Cell(60,7,'Approved : '.$approved,0,1);

$pdf->Cell(60,7,'Pending : '.$pending,0,1);

$pdf->Cell(60,7,'Rejected : '.$rejected,0,1);

$pdf->Ln(12);

/* ===========================
   TANDA TANGAN
=========================== */

$pdf->Cell(0,6,'Purwokerto, '.date('d F Y'),0,1,'R');

$pdf->Ln(4);

$pdf->Cell(0,6,'Admin RoomBook',0,1,'R');

$pdf->Ln(18);

$pdf->Cell(
0,
6,
$_SESSION['nama'],
0,
1,
'R'
);

$pdf->Output(
'I',
'Laporan_Peminjaman_Ruangan.pdf'
);

?>