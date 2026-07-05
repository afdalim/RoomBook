<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Daftar Akun | RoomBook</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{

margin:0;

padding:0;

box-sizing:border-box;

font-family:'Poppins',sans-serif;

}

body{

min-height:100vh;

background:linear-gradient(135deg,#1565C0,#1E88E5,#64B5F6);

display:flex;

justify-content:center;

align-items:center;

padding:40px 15px;

position:relative;

overflow:auto;

}

body::before{

content:"";

position:absolute;

width:500px;

height:500px;

background:rgba(255,255,255,.06);

border-radius:50%;

top:-180px;

right:-180px;

}

body::after{

content:"";

position:absolute;

width:450px;

height:450px;

background:rgba(255,255,255,.05);

border-radius:50%;

bottom:-180px;

left:-180px;

}

.register-card{

position:relative;

z-index:99;

width:100%;

max-width:520px;

background:white;

border-radius:25px;

padding:35px;

box-shadow:0 20px 60px rgba(0,0,0,.20);

animation:fade .6s;

}

.logo{

width:75px;

margin-bottom:10px;

}

.logo-app{

width:60px;

margin-left:10px;

}

.title{

font-size:30px;

font-weight:700;

color:#1565C0;

margin-top:15px;

}

.subtitle{

color:#666;

font-size:14px;

margin-bottom:25px;

}

.form-control{

height:50px;

border-radius:12px;

}

.input-group-text{

background:white;

border-right:none;

}

.form-control{

border-left:none;

}

.form-control:focus{

box-shadow:none;

}

.btn-register{

height:52px;

border-radius:12px;

background:#1565C0;

color:white;

font-weight:600;

font-size:16px;

border:none;

transition:.3s;

}

.btn-register:hover{

background:#0D47A1;

transform:translateY(-2px);

box-shadow:0 10px 25px rgba(21,101,192,.35);

}

.footer{

font-size:13px;

color:#888;

margin-top:20px;

text-align:center;

}

@keyframes fade{

from{

opacity:0;

transform:translateY(30px);

}

to{

opacity:1;

transform:translateY(0);

}

}

</style>

</head>

<body>

<div class="register-card">

<div class="text-center">

<img src="../assets/img/hero.png" class="logo">

<img src="../assets/img/roombook-logo.png" class="logo-app">

<h2 class="title">

ROOMBOOK

</h2>

<p class="subtitle">

Daftar Akun Mahasiswa

<br>

<b>SEKOLAH TINGGI ILMU KOMPUTER YOS SUDARSO</b>

</p>

</div>

<form action="register_proses.php" method="POST">

<div class="form-group">

<label>Nama Lengkap</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-user"></i>

</span>

</div>

<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>

</div>

</div>

<div class="form-group">

<label>NIM</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-id-card"></i>

</span>

</div>

<input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>

</div>

</div>

<div class="form-group">

<label>Program Studi</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-graduation-cap"></i>

</span>

</div>

<input type="text" name="prodi" class="form-control" placeholder="Masukkan Program Studi" required>

</div>

</div>

<div class="form-group">

<label>Email</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-envelope"></i>

</span>

</div>

<input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>

</div>

</div>

<div class="form-group">

<label>No HP</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-phone"></i>

</span>

</div>

<input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>

</div>

</div>

<div class="form-group">

<label>Password</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-lock"></i>

</span>

</div>

<input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>

<div class="input-group-append">

<span class="input-group-text" onclick="togglePassword('password',this)">

<i class="fas fa-eye"></i>

</span>

</div>

</div>

</div>

<div class="form-group">

<label>Konfirmasi Password</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-lock"></i>

</span>

</div>

<input type="password" id="konfirmasi" name="konfirmasi" class="form-control" placeholder="Ulangi Password" required>

<div class="input-group-append">

<span class="input-group-text" onclick="togglePassword('konfirmasi',this)">

<i class="fas fa-eye"></i>

</span>

</div>

</div>

</div>

<button class="btn btn-register btn-block">

<i class="fas fa-user-plus"></i>

Daftar Sekarang

</button>

</form>

<div class="text-center mt-4">

Sudah punya akun?

<a href="login.php">

<b>Masuk</b>

</a>

</div>

<div class="footer">

© <?= date('Y') ?> RoomBook

<br>

Developed by Afdal Indra Maulana

</div>

</div>

<script>

function togglePassword(id,el){

const input=document.getElementById(id);

const icon=el.querySelector("i");

if(input.type==="password"){

input.type="text";

icon.classList.remove("fa-eye");

icon.classList.add("fa-eye-slash");

}else{

input.type="password";

icon.classList.remove("fa-eye-slash");

icon.classList.add("fa-eye");

}

}

</script>

</body>

</html>