<?php
include_once "../../auth.php";
include_once "../../authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$id = $_GET['id'] ?? "";
if (isset($_GET['id'])) {
    $query = "SELECT * FROM terminal WHERE id_terminal = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

$nama = $data['nama_terminal'] ?? "";
$lokasi = $data['lokasi_terminal'] ?? "";
$kapasitas = $data['kapasitas_penyimpanan'] ?? "";

if (isset($_POST['update'])) {
    $id2 = $_POST['id'];
    $nama2 = $_POST['nama'];
    $lokasi2 = $_POST['lokasi'];
    $kapasitas2 = $_POST['kapasitas'];
    $query = "UPDATE terminal SET nama_terminal = '$nama2',lokasi_terminal = '$lokasi2',kapasitas_penyimpanan = $kapasitas2 WHERE id_terminal = $id2";
    if (mysqli_query($conn, $query)) {
        header("location:../../terminal.php");
    } else {
        echo "Data gagal diupdate";
    }
}

if (isset($_POST['batal'])) {
    header("location:../../terminal.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <h2 style="text-align: center;">Edit Data Terminal</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="edterminal.php" method="post" style="padding:10px">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Terminal:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;" value="<?= $nama ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi terminal:</label>
                                <input type="text" name="lokasi" class="form-control" style="width: 300px;" value="<?= $lokasi ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">kapasitas penyimpanan:</label>
                                <input type="text" name="kapasitas" class="form-control" style="width: 300px;" value="<?= $kapasitas ?>">
                            </div>
                        </tr>
                        <tr class="m-4">
                            <td>
                                <button type="submit" name="update" class="btn btn-success w-100 mt-1 mb-1">Update</button>
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