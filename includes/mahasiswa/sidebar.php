<aside class="main-sidebar sidebar-dark-success elevation-4">

<a href="/roombook/mahasiswa/dashboard.php" class="brand-link">

<img
src="/roombook/assets/img/hero.png"
alt="Logo"
class="brand-image img-circle elevation-3"
style="opacity:.9">

<span class="brand-text font-weight-bold">

RoomBook

</span>

</a>

<div class="sidebar">

<!-- USER PANEL -->

<div class="user-panel mt-3 pb-3 mb-3 d-flex">

<div class="image">

<img

src="https://ui-avatars.com/api/?background=198754&color=fff&name=<?= urlencode($_SESSION['nama']) ?>"

class="img-circle elevation-2">

</div>

<div class="info">

<a href="/roombook/mahasiswa/profile/index.php" class="d-block">

<?= $_SESSION['nama']; ?>

</a>

<small class="text-light">

Mahasiswa

</small>

</div>

</div>

<nav class="mt-2">

<ul
class="nav nav-pills nav-sidebar flex-column"
data-widget="treeview"
role="menu">

<li class="nav-item">

<a
href="/roombook/mahasiswa/dashboard.php"
class="nav-link">

<i class="nav-icon fas fa-home"></i>

<p>Dashboard</p>

</a>

</li>

<li class="nav-item">

<a
href="/roombook/mahasiswa/rooms/index.php"
class="nav-link">

<i class="nav-icon fas fa-door-open"></i>

<p>Booking Ruangan</p>

</a>

</li>

<li class="nav-item">

<a
href="/roombook/mahasiswa/bookings/index.php"
class="nav-link">

<i class="nav-icon fas fa-history"></i>

<p>Riwayat Booking</p>

</a>

</li>

<li class="nav-item">

<a
href="/roombook/mahasiswa/profile/index.php"
class="nav-link">

<i class="nav-icon fas fa-user-circle"></i>

<p>Profil Saya</p>

</a>

</li>

<li class="nav-item">

<a
href="/roombook/auth/logout.php"
class="nav-link text-danger">

<i class="nav-icon fas fa-sign-out-alt"></i>

<p>Logout</p>

</a>

</li>

</ul>

</nav>

</div>

</aside>