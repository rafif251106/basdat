<?php
include_once "./auth.php";
include_once "./authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT * FROM kendaraan";
$result = mysqli_query($conn, $query);
$kendaraan = mysqli_fetch_all($result, MYSQLI_ASSOC);

$status = $_POST['status'] ?? "";
if (isset($_POST['filter']) && !empty($status)) {
    $query = "SELECT * FROM kendaraan WHERE status_kendaraan = '$status'";
    $result = mysqli_query($conn, $query);
    $kendaraan = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        <?php if (isset($_POST['filter'])): ?>.alltable {
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
            <label for="status" class="form-label">Status Kendaraan:</label>
            <div class="mb-3 d-flex align-items-center gap-2">
                <select name="status" id="status" class="form-control" style="width: 300px;">
                    <option value="" <?= $status == '' ? 'selected' : '' ?>>Pilih Status</option>
                    <option value="aktif" <?= $status == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="rusak" <?= $status == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                    <option value="maintenance" <?= $status == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                </select>
                <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                <a href="kendaraan.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        <a href="./crud/kendaraan/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary alltable">
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
    </div>
    <?php if (isset($_POST['filter'])): ?>
        <div class="container">
            <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
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
        </div>
    <?php endif; ?>
</body>

</html>