<!DOCTYPE html>
<html lang="en">
<nav class="navbar sticky-top navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fst-italic" href="/basdat/index.php">
            PERTAMINA
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/basdat/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/basdat/laporan.php">Laporan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengiriman
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/basdat/crud/pengiriman/tambah.php">Input Pengiriman Baru</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/basdat/pengiriman.php">Riwayat Pengiriman</a></li>
                    </ul>
                </li>
                
                <?php if ($_SESSION['level'] == "admin"): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><h6 class="dropdown-header text-muted">Wilayah & Fasilitas</h6></li>
                            <li><a class="dropdown-item" href="/basdat/terminal.php">Data Terminal</a></li>
                            <li><a class="dropdown-item" href="/basdat/spbu.php">Data SPBU</a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header text-muted">Armada & SDM</h6></li>
                            <li><a class="dropdown-item" href="/basdat/kendaraan.php">Data Kendaraan</a></li>
                            <li><a class="dropdown-item" href="/basdat/sopir.php">Data Sopir</a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header text-muted">Lainnya</h6></li>
                            <li><a class="dropdown-item" href="/basdat/produk.php">Data Produk BBM</a></li>
                            <li><a class="dropdown-item" href="/basdat/users.php">Manajemen Users</a></li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
            
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div style="width: 30px; height: 30px; background-color: white; color: #0958a7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                            <?= substr($_SESSION['nama'], 0, 1) ?>
                        </div>
                        <?php echo ucwords($_SESSION['nama']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="px-3 py-2 text-muted" style="font-size: 0.8rem;">
                            <strong><?= strtoupper($_SESSION['level']) ?></strong>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/basdat/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
</html>