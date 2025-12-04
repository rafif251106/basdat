<?php
include_once "../../auth.php";
include_once "../../authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_POST['batal'])) {
    header("location:../../produk.php");
}


if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'] ?? "";
    $jenis = $_POST['jenis'] ?? "";
    $harga = $_POST['harga'] ?? "";

    $query = "INSERT INTO produk_bbm(nama_produk,jenis_bbm,harga_per_liter) VALUES 
    (?,?,?)";
    $prepare = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($prepare, "ssi", $nama, $jenis, $harga);
    if (mysqli_stmt_execute($prepare)) {
        header("location:../../produk.php");
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
    <h2 style="text-align: center;">Tambah Data Produk</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="tambah.php" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis BBM:</label>
                                <select class="form-select" aria-label="Default select example" name="jenis">
                                    <option selected>Pilih Jenis BBM</option>
                                    <option value="bensin">Bensin</option>
                                    <option value="diesel">Diesel</option>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga per Liter:</label>
                                <input type="number" name="harga" class="form-control" style="width: 300px;">
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