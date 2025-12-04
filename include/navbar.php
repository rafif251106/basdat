<!DOCTYPE html>
<html lang="en">
<nav class="navbar sticky-top navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Pertamina</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link home active" aria-current="page" href="/basdat/homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link home active" aria-current="page" href="/basdat/laporan.php">Laporan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pengiriman</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/basdat/crud/pengiriman/tambah.php">Tambah Data Pengiriman</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/basdat/pengiriman.php">Data Pengiriman</a></li>
                    </ul>
                </li>
                <?php if ($_SESSION['level'] == "admin"): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/basdat/terminal.php">Data Terminal</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/basdat/spbu.php">Data SPBU</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/basdat/kendaraan.php">Data Kendaraan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/basdat/sopir.php">Data Sopir</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/basdat/produk.php">Data Produk</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/basdat/users.php">Data Users</a></li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
            <!-- <form class="d-flex" action="navbar.php" method="post"> -->
            <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                <li class="nav-item dropdown me-5">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo ucwords($_SESSION['nama']) ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/basdat/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <!-- </form> -->
        </div>
    </div>
</nav>