<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">

<!-- LEFT -->

<ul class="navbar-nav">

<li class="nav-item">

<a
class="nav-link"
data-widget="pushmenu"
href="#">

<i class="fas fa-bars"></i>

</a>

</li>

<li class="nav-item d-none d-sm-inline-block">

<a
href="/roombook/admin/dashboard.php"
class="nav-link">

Dashboard

</a>

</li>

</ul>

<!-- RIGHT -->

<ul class="navbar-nav ml-auto">

<!-- JAM -->

<li class="nav-item">

<span class="nav-link text-secondary">

<i class="far fa-clock"></i>

<span id="clock"></span>

</span>

</li>

<!-- PROFILE -->

<li class="nav-item dropdown">

<a
class="nav-link"
data-toggle="dropdown"
href="#">

<img

src="https://ui-avatars.com/api/?background=0D6EFD&color=fff&name=<?= urlencode($_SESSION['nama']) ?>"

class="img-circle elevation-2"

style="width:34px;height:34px;">

<span class="ml-2 font-weight-bold">

<?= $_SESSION['nama']; ?>

</span>

<i class="fas fa-chevron-down ml-1"></i>

</a>

<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

<div class="dropdown-header">

<b><?= $_SESSION['nama']; ?></b>

<br>

<small>Administrator</small>

</div>

<div class="dropdown-divider"></div>

<a
href="/roombook/admin/profile/index.php"
class="dropdown-item">

<i class="fas fa-user mr-2"></i>

Profil Saya

</a>

<div class="dropdown-divider"></div>

<a
href="/roombook/auth/logout.php"
class="dropdown-item text-danger">

<i class="fas fa-sign-out-alt mr-2"></i>

Logout

</a>

</div>

</li>

</ul>

</nav>

<script>

function updateClock(){

const now=new Date();

const jam=String(now.getHours()).padStart(2,'0');

const menit=String(now.getMinutes()).padStart(2,'0');

const detik=String(now.getSeconds()).padStart(2,'0');

document.getElementById("clock").innerHTML=

jam+":"+menit+":"+detik;

}

setInterval(updateClock,1000);

updateClock();

</script>