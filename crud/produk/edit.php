<?php
include_once "../../auth.php";
include_once "../../authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_POST['batal'])) {
    header("location:../../produk.php");
}

$id = $_GET['id'];
$query = "SELECT * FROM produk_bbm WHERE id_produk = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$nama = $data['nama_produk'];
$jenis = $data['jenis_bbm'];
$harga = $data['harga_per_liter'];
if (isset($_POST['update'])) {
    $nama = $_POST['nama'] ?? "";
    $jenis = $_POST['jenis'] ?? "";
    $harga = $_POST['harga'] ?? "";

    $query = "UPDATE produk_bbm SET nama_produk = ?,jenis_bbm = ?,harga_per_liter = ? WHERE id_produk = ?";
    $prepare = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($prepare, "ssii", $nama, $jenis, $harga,$id);
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
    <link rel="stylesheet" href="../../css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <div class="container">
        <h2 style="text-align: center;">Edit Data Produk</h2>
    </div>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="edit.php?id=<?= $id ?>" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;" value="<?= $nama ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis BBM:</label>
                                <select class="form-select" aria-label="Default select example" name="jenis">
                                    <?php if ($jenis == "bensin"): ?>
                                        <option value="<?= $jenis ?>"><?php echo ucwords($jenis) ?></option>
                                        <option value="diesel">Diesel</option>
                                    <?php elseif ($jenis == "diesel"): ?>
                                        <option value="<?= $jenis ?>"><?php echo ucwords($jenis) ?></option>
                                        <option value="bensin">Bensin</option>
                                    <?php endif ?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga per Liter:</label>
                                <input type="number" name="harga" class="form-control" style="width: 300px;" value="<?= $harga ?>">
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