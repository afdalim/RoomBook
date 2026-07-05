<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="/roombook/admin/dashboard.php" class="brand-link">

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

<!-- USER -->

<div class="user-panel mt-3 pb-3 mb-3 d-flex">

<div class="image">

<img

src="https://ui-avatars.com/api/?background=0D6EFD&color=fff&name=<?= urlencode($_SESSION['nama']) ?>"

class="img-circle elevation-2">

</div>

<div class="info">

<a href="/roombook/admin/profile/index.php" class="d-block">

<?= $_SESSION['nama']; ?>

</a>

<small class="text-light">

Administrator

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

href="/roombook/admin/dashboard.php"

class="nav-link">

<i class="nav-icon fas fa-home"></i>

<p>Dashboard</p>

</a>

</li>

<li class="nav-item">

<a

href="/roombook/admin/rooms/index.php"

class="nav-link">

<i class="nav-icon fas fa-door-open"></i>

<p>Data Ruangan</p>

</a>

</li>

<li class="nav-item">

<a

href="/roombook/admin/bookings/index.php"

class="nav-link">

<i class="nav-icon fas fa-calendar-check"></i>

<p>Pengajuan</p>

</a>

</li>

<li class="nav-item">

<a

href="/roombook/admin/reports/index.php"

class="nav-link">

<i class="nav-icon fas fa-file-alt"></i>

<p>Laporan</p>

</a>

</li>

<li class="nav-item">

<a

href="/roombook/admin/profile/index.php"

class="nav-link">

<i class="nav-icon fas fa-user-circle"></i>

<p>Profil</p>

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