<?php

session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../../auth/login.php");
    exit;
}

require('../../library/fpdf/fpdf.php');
include('../../config/koneksi.php');

$idBooking = $_GET['id'];
$idUser    = $_SESSION['id_user'];

$query = mysqli_query($conn,"
SELECT

b.*,

u.nama,
u.nim,
u.prodi,

r.nama_ruang,
r.lokasi,
r.kapasitas

FROM bookings b

JOIN users u
ON b.id_user=u.id_user

JOIN rooms r
ON b.id_room=r.id_room

WHERE

b.id_booking='$idBooking'

AND

b.id_user='$idUser'

AND

b.status='Approved'

");

$data = mysqli_fetch_assoc($query);

if(!$data){

    die("Data tidak ditemukan.");

}

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

$pdf->SetAutoPageBreak(true,20);

$pdf->Image('../../assets/img/logo-stikom.png',15,10,25);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,8,'SEKOLAH TINGGI ILMU KOMPUTER',0,1,'C');

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,8,'YOS SUDARSO',0,1,'C');

$pdf->SetFont('Arial','',11);
$pdf->Cell(0,6,'Sistem Informasi Peminjaman Ruangan Organisasi Mahasiswa',0,1,'C');

$pdf->Ln(3);

$pdf->Line(10,35,200,35);
$pdf->Line(10,36,200,36);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',15);

$pdf->Cell(0,8,'BUKTI PEMINJAMAN RUANGAN',0,1,'C');

$pdf->SetFont('Arial','',11);

$pdf->Cell(0,6,'Nomor Surat : '.$data['nomor_surat'],0,1,'C');

$pdf->Ln(8);

$pdf->SetFont('Arial','',11);

$pdf->Cell(55,8,'Nama Mahasiswa',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['nama'],0,1);

$pdf->Cell(55,8,'NIM',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['nim'],0,1);

$pdf->Cell(55,8,'Program Studi',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['prodi'],0,1);

$pdf->Cell(55,8,'Organisasi',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['organisasi'],0,1);

$pdf->Cell(55,8,'Ruangan',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['nama_ruang'],0,1);

$pdf->Cell(55,8,'Lokasi',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['lokasi'],0,1);

$pdf->Cell(55,8,'Tanggal',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(
120,
8,
date('d F Y',strtotime($data['tanggal'])),
0,
1
);

$pdf->Cell(55,8,'Jam',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(
120,
8,
date('H:i',strtotime($data['jam_mulai'])).
" - ".
date('H:i',strtotime($data['jam_selesai'])),
0,
1
);

$pdf->Cell(55,8,'Jumlah Peserta',0,0);
$pdf->Cell(5,8,':',0,0);
$pdf->Cell(120,8,$data['jumlah_peserta'].' Orang',0,1);


/* ==========================
   KEPERLUAN
========================== */

$pdf->Ln(3);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(55,8,'Keperluan',0,1);

$pdf->SetFont('Arial','',11);

$pdf->MultiCell(
180,
7,
$data['keperluan'],
1,
'L'
);

$pdf->Ln(8);

/* ==========================
   STATUS
========================== */

$pdf->SetFont('Arial','B',13);

$pdf->SetFillColor(220,255,220);

$pdf->Cell(
190,
10,
'STATUS : DISETUJUI (APPROVED)',
1,
1,
'C',
true
);

$pdf->Ln(10);

/* ==========================
   TANGGAL PERSETUJUAN
========================== */

$pdf->SetFont('Arial','',11);

$pdf->Cell(
100,
7,
'Disetujui pada : '
.date('d F Y H:i',strtotime($data['approved_at'])),
0,
1
);

$pdf->Ln(10);

/* ==========================
   TANDA TANGAN
========================== */

$pdf->Cell(110);

$pdf->Cell(
70,
7,
'Mengetahui,',
0,
1,
'C'
);

$pdf->Cell(110);

$pdf->Cell(
70,
7,
'Administrator RoomBook',
0,
1,
'C'
);

$pdf->Ln(25);

$pdf->Cell(110);

$pdf->SetFont('Arial','B',11);

$pdf->Cell(
70,
7,
'( Afdal Indra Maulana, S.Kom )',
0,
1,
'C'
);

/* ==========================
   FOOTER
========================== */

$pdf->Ln(15);

$pdf->SetDrawColor(180,180,180);
$pdf->Line(10,$pdf->GetY(),200,$pdf->GetY());

$pdf->Ln(5);

$pdf->SetFont('Arial','I',9);

$pdf->Cell(
0,
5,
'Dokumen ini dicetak secara otomatis melalui Sistem RoomBook',
0,
1,
'C'
);

$pdf->Cell(
0,
5,
'SEKOLAH TINGGI ILMU KOMPUTER YOS SUDARSO',
0,
1,
'C'
);

$pdf->Cell(
0,
5,
date('d F Y H:i').' WIB',
0,
1,
'C'
);

/* ==========================
   DOWNLOAD PDF
========================== */

$namaFile = "Bukti_Peminjaman_".$data['nomor_surat'].".pdf";

$pdf->Output('D',$namaFile);

exit;

?>