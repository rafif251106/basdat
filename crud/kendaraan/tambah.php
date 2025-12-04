<?php
include_once "../../auth.php";
include_once "../../authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_POST['batal'])) {
    header("location:../../kendaraan.php");
}


$polisi = $_POST['polisi'] ?? "";
$status = $_POST['status'] ?? "";
$kapasitas = $_POST['kapasitas'] ?? "";
if (isset($_POST['tambah'])) {
    $query = "INSERT INTO kendaraan(plat_nomor,status_kendaraan,kapasitas_tangki) VALUES 
    ('$polisi','$status','$kapasitas')";
    if (mysqli_query($conn, $query)) {
        header("location:../../kendaraan.php");
    } else {
        echo "data gagal ditambahkan";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <h2 style="text-align: center;">Tambah Data Kendaraan</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="tambah.php" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="polisi" class="form-label">Nomor Polisi:</label>
                                <input type="text" name="polisi" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kendaraan:</label>
                                <select name="status" id="status" class="form-control" style="width: 300px;">
                                    <option value="aktif" <?= $status == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="rusak" <?= $status == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                                    <option value="maintenance" <?= $status == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas Tangki:</label>
                                <input type="text" name="kapasitas" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr class="m-4">
                            <td>
                                <button type="submit" name="tambah" class="btn btn-success w-100 mt-1 mb-1">Tambah</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="batal" class="btn btn-danger w-100">Batal</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>