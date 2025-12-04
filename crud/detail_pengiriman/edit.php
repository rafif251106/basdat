<?php
include_once "../../auth.php";
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");

$id_pengiriman = $_GET['id_pengiriman'];
$id_produk = $_GET['id_produk'];
$query = "SELECT id_produk,nama_produk FROM produk_bbm WHERE id_produk = '$id_produk'";
$result = mysqli_query($conn, $query);
$prselect = mysqli_fetch_assoc($result);

$query = "SELECT pb.id_produk,pb.nama_produk FROM produk_bbm pb WHERE pb.id_produk NOT IN (SELECT dp.id_produk FROM detail_pengiriman dp WHERE dp.id_pengiriman = $id_pengiriman)";
$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT * FROM detail_pengiriman WHERE id_produk = '$id_produk' && id_pengiriman = '$id_pengiriman'";
$result = mysqli_query($conn, $query);
$jumlah = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $produk = $_POST['produk'] ?? "";
    $jumlah = $_POST['jumlah'] ?? "";
    $query = "UPDATE detail_pengiriman SET id_produk = ?,jumlah_liter_produk = ? WHERE id_pengiriman = ? && id_produk = ?";
    $prepare = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($prepare, "iiii", $produk, $jumlah, $id_pengiriman,$id_produk);
    if (mysqli_stmt_execute($prepare)) {
        header("location:../../detail_pengiriman.php?id=" . $id_pengiriman);
    } else {
        echo "data gagal ditambahkan";
    }
}

if (isset($_POST['batal'])) {
    header("location:../../detail_pengiriman.php?id=" . $id_pengiriman);
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
    <h2 style="text-align: center;">Edit Data Detail Pengiriman</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="edit.php?id_pengiriman=<?= $id_pengiriman ?>&id_produk=<?= $id_produk ?>" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="produk" class="form-label">Produk:</label>
                                <select class="form-select" aria-label="Default select example" name="produk">
                                    <option value="<?= $prselect['id_produk'] ?>"><?php echo $prselect['nama_produk'] ?></option>
                                    <?php foreach ($produk as $p): ?>
                                        <option value="<?= $p['id_produk'] ?>"><?php echo $p['nama_produk'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Liter Produk:</label>
                                <input type="number" name="jumlah" class="form-control" style="width: 300px;" value=<?= $jumlah['jumlah_liter_produk'] ?>>
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