<?php
include_once "./auth.php";
include_once "./authadmin.php";
include_once "./config.php";

$conn = connection();
$query = "SELECT * FROM kendaraan";
$result = mysqli_query($conn, $query);
$kendaraan = mysqli_fetch_all($result, MYSQLI_ASSOC);

$status = $_POST['status'] ?? "";
$kapasitas_tangki = $_POST['kapasitas_tangki'] ?? "";
if (isset($_POST['filter']) && !empty($status)) {
    $query = "SELECT * FROM kendaraan WHERE status_kendaraan = '$status'";
    $result = mysqli_query($conn, $query);
    $kendaraanf = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if (isset($_POST['filter']) && !empty($kapasitas_tangki)) {
    if (!empty($status)) {
        if ($kapasitas_tangki == '>20000') {
            $query = "SELECT * FROM kendaraan WHERE status_kendaraan = '$status' AND kapasitas_tangki > 20000";
        } elseif ($kapasitas_tangki == '<20000') {
            $query = "SELECT * FROM kendaraan WHERE status_kendaraan = '$status' AND kapasitas_tangki < 20000";
        }
    } else {
        if ($kapasitas_tangki == '>20000') {
            $query = "SELECT * FROM kendaraan WHERE kapasitas_tangki > 20000";
        } elseif ($kapasitas_tangki == '<20000') {
            $query = "SELECT * FROM kendaraan WHERE kapasitas_tangki < 20000";
        }
    }
    $result = mysqli_query($conn, $query);
    $kendaraanf = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$plat_nomor = $_POST['plat_nomor'] ?? "";
if (isset($_POST['cari']) && !empty($plat_nomor)) {
    $query = "SELECT * FROM kendaraan WHERE plat_nomor LIKE '%$plat_nomor%'";
    $result = mysqli_query($conn, $query);
    $kendaraanc = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kendaraanc[] = $row;
    }
}
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        <?php if (isset($_POST['filter']) || (isset($_POST['cari']) && !empty($plat_nomor))): ?>.kendaraan {
            display: none;
        }

        <?php endif; ?><?php if (isset($_POST['filter'])): ?>.kendaraanc {
            display: none;
        }

        <?php endif; ?>
    </style>
</head>

<body>
    <?php
    require_once __DIR__ . "/include/navbar.php";
    ?>
    <div class="container">
        <h2>Kendaraan</h2>
        <form action="kendaraan.php" method="post">
            <div class="d-flex align-items-end gap-3">
                <div class="d-flex flex-column">
                    <label for="status" class="form-label mb-1">Status Kendaraan:</label>
                    <select name="status" id="status" class="form-control" style="width: 180px;">
                        <option value="" <?= $status == '' ? 'selected' : '' ?>>Pilih Status</option>
                        <option value="aktif" <?= $status == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="rusak" <?= $status == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                        <option value="maintenance" <?= $status == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                    </select>
                </div>
                <div class="d-flex flex-column">
                    <label for="kapasitas_tangki" class="form-label mb-1">Kapasitas Tangki:</label>
                    <select name="kapasitas_tangki" id="kapasitas_tangki" class="form-control" style="width: 180px;">
                        <option value="" <?= $kapasitas_tangki == '' ? 'selected' : '' ?>>Pilih Kapasitas Tangki</option>
                        <option value=">20000" <?= $kapasitas_tangki == '>20000' ? 'selected' : '' ?>> > 20000</option>
                        <option value="<20000" <?= $kapasitas_tangki == '<20000' ? 'selected' : '' ?>> < 20000</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                </div>
            </div>
        </form>
        <form action="kendaraan.php" method="post">
            <input type="search" name="plat_nomor" class="form-control" style="width: 250px; display: inline-block;" placeholder="Masukkan plat nomor" list="plat_nomor">
            <button type="submit" name="cari" class="btn btn-primary mb-2">Search</button>
            <button type="submit" name="reset" class="btn btn-danger mb-2" onclick="<?= header("location:kendaraan.php") ?>">Reset</button>
        </form>
        <a href="./crud/kendaraan/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary kendaraan">
            <tr class="table-dark">
                <th>ID Kendaraan</th>
                <th>Nomor Polisi</th>
                <th>Kapasitas Tangki</th>
                <th>Status Kendaraan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($kendaraan as $k): ?>
                <tr>
                    <td><?php echo $k['id_kendaraan'] ?></td>
                    <td><?php echo $k['plat_nomor'] ?></td>
                    <td><?php echo $k['kapasitas_tangki'] ?></td>
                    <td><?php echo $k['status_kendaraan'] ?></td>
                    <td>
                        <a href="./crud/kendaraan/delete.php?id=<?= $k['id_kendaraan'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/kendaraan/edit.php?id=<?= $k['id_kendaraan'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if (isset($_POST['cari']) && !empty($plat_nomor)): ?>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary kendaraanc">
            <tr class="table-dark">
                <th>ID Kendaraan</th>
                <th>Nomor Polisi</th>
                <th>Kapasitas Tangki</th>
                <th>Status Kendaraan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($kendaraanc as $k): ?>
            <tr>
                <td><?php echo $k['id_kendaraan'] ?></td>
                <td><?php echo $k['plat_nomor'] ?></td>
                <td><?php echo $k['kapasitas_tangki'] ?></td>
                <td><?php echo $k['status_kendaraan'] ?></td>
                <td>
                    <a href="./crud/kendaraan/delete.php?id=<?= $k['id_kendaraan'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                    <a href="./crud/kendaraan/edit.php?id=<?= $k['id_kendaraan'] ?>" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <?php if (isset($_POST['filter'])): ?>
        <?php if (empty($kendaraanf)): ?>
            <h2 style="color: white;">Tidak Ada Data</h2>
        <?php else: ?>
            <div class="container">
                <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
                    <tr class="table-dark">
                        <th>ID Kendaraan</th>
                        <th>Nomor Polisi</th>
                        <th>Kapasitas Tangki</th>
                        <th>Status Kendaraan</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($kendaraanf as $k): ?>
                        <tr>
                            <td><?php echo $k['id_kendaraan'] ?></td>
                            <td><?php echo $k['plat_nomor'] ?></td>
                            <td><?php echo $k['kapasitas_tangki'] ?></td>
                            <td><?php echo $k['status_kendaraan'] ?></td>
                            <td>
                                <a href="./crud/kendaraan/delete.php?id=<?= $k['id_kendaraan'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                                <a href="./crud/kendaraan/edit.php?id=<?= $k['id_kendaraan'] ?>" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>