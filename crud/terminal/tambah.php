<?php
include_once "../../auth.php";
include_once "../../config.php";
checkLogin();
checkAdmin();


$conn = connection();
if (isset($_POST['batal'])) {
    header("location:../../terminal.php");
}


$nama = $_POST['nama'] ?? "";
$lokasi = $_POST['lokasi'] ?? "";
$kapasitas = $_POST['kapasitas'] ?? "";
if (isset($_POST['tambah'])) {
    $query = "INSERT INTO terminal(nama_terminal,lokasi_terminal,kapasitas_penyimpanan) VALUES 
    ('$nama','$lokasi','$kapasitas')";
    if (mysqli_query($conn, $query)) {
        header("location:../../terminal.php");
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
    <link rel="stylesheet" href="../../css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <div class="container">
        <h2 style="text-align: center;">Tambah Data Terminal</h2>
    </div>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="tambah.php" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Terminal:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi terminal:</label>
                                <input type="text" name="lokasi" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">kapasitas penyimpanan:</label>
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