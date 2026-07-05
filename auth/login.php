<?php
session_start();

if(isset($_SESSION['role'])){

    if($_SESSION['role']=="admin"){
        header("Location: ../admin/dashboard.php");
    }else{
        header("Location: ../mahasiswa/dashboard.php");
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Login | RoomBook</title>

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

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

overflow:auto;

}

body::before{

content:"";

position:fixed;

width:550px;

height:550px;

background:rgba(255,255,255,.07);

border-radius:50%;

top:-220px;

right:-200px;

}

body::after{

content:"";

position:fixed;

width:450px;

height:450px;

background:rgba(255,255,255,.06);

border-radius:50%;

left:-170px;

bottom:-180px;

}

.login-card{

position:relative;

width:100%;

max-width:470px;

background:white;

border-radius:25px;

padding:40px;

box-shadow:0 20px 60px rgba(0,0,0,.20);

z-index:100;

animation:fade .5s;

}

.logo{

width:80px;

margin-bottom:15px;

}

.title{

font-size:30px;

font-weight:700;

color:#1565C0;

}

.subtitle{

font-size:14px;

color:#666;

margin-bottom:30px;

}

.form-group{

margin-bottom:20px;

}

.form-control{

height:50px;

border-left:none;

}

.input-group{

border-radius:12px;

overflow:hidden;

}

.input-group-text{

background:white;

border-right:none;

}

.form-control:focus{

box-shadow:none;

}

.btn-login{

height:52px;

border:none;

border-radius:12px;

background:#1565C0;

font-weight:600;

font-size:16px;

color:white;

transition:.3s;

}

.btn-login:hover{

background:#0D47A1;

transform:translateY(-2px);

}

.footer{

margin-top:20px;

font-size:13px;

color:#777;

text-align:center;

}

@keyframes fade{

from{

opacity:0;

transform:translateY(25px);

}

to{

opacity:1;

transform:translateY(0);

}

}

</style>

</head>

<body>

<div class="login-card">

<div class="text-center mb-4">

<img
src="../assets/img/hero.png"
class="logo">


<h2 class="title">

ROOMBOOK

</h2>

<p class="subtitle">

Sistem Peminjaman Ruangan

<br>

<b>SEKOLAH TINGGI ILMU KOMPUTER YOS SUDARSO</b>

</p>

</div>

<?php

if(isset($_GET['error'])){

?>

<div class="alert alert-danger text-center">

<i class="fas fa-exclamation-circle"></i>

Email atau Password Salah

</div>

<?php } ?>

<form action="login_proses.php" method="POST">

<div class="form-group">

<label>Email</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<i class="fas fa-envelope"></i>

</span>

</div>

<input

type="email"

name="email"

class="form-control"

placeholder="Masukkan Email"

required>

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

<input

type="password"

name="password"

id="password"

class="form-control"

placeholder="Masukkan Password"

required>

<div class="input-group-append">

<span

class="input-group-text"

onclick="lihatPassword()"

style="cursor:pointer;">

<i

id="icon"

class="fas fa-eye">

</i>

</span>

</div>

</div>

</div>

<button
type="submit"
class="btn btn-login btn-block">

<i class="fas fa-sign-in-alt"></i>

Masuk

</button>

</form>

<div class="text-center mt-4">

Belum punya akun?

<a href="register.php">

<b>Daftar Sekarang</b>

</a>

</div>

<div class="footer">

© <?= date('Y') ?>

RoomBook

<br>

Developed by

<b>Afdal Indra Maulana</b>

</div>

</div>

<script>

function lihatPassword(){

    const password = document.getElementById("password");
    const icon = document.getElementById("icon");

    if(password.type === "password"){

        password.type = "text";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");

    }else{

        password.type = "password";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");

    }

}

</script>

</body>

</html>