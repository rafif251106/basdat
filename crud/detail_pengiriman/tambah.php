<?php
include_once "../../auth.php";
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");

$id = $_GET['id'];
$query = "SELECT pb.id_produk,pb.nama_produk FROM produk_bbm pb WHERE pb.id_produk NOT IN (SELECT dp.id_produk FROM detail_pengiriman dp WHERE dp.id_pengiriman = '$id')";
$result = mysqli_query($conn,$query);
$produk = mysqli_fetch_all($result,MYSQLI_ASSOC);

if (isset($_POST['tambah'])) {
    $produk = $_POST['produk'] ?? "";
    $jumlah = $_POST['jumlah'] ?? "";
    $query = "INSERT INTO detail_pengiriman(id_pengiriman,id_produk,jumlah_liter_produk) VALUES 
    (?,?,?)";
    $prepare = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($prepare,"iii",$id,$produk,$jumlah);
    if (mysqli_stmt_execute($prepare)) {
        echo "
    <script>
        if (confirm('Tambah data lagi?')) {
            window.location.href = 'tambah.php?id=$id';
        } else {
            window.location.href = '../../detail_pengiriman.php?id=$id';
        }
    </script>
    ";
        exit;
    } else {
        echo "data gagal ditambahkan";
    }
}

if (isset($_POST['batal'])) {
    header("location:../../detail_pengiriman.php?id=".$id);
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
    <h2 style="text-align: center;">Tambah Data Detail Pengiriman</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="tambah.php?id=<?= $id ?>" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="produk" class="form-label">Produk:</label>
                                <select class="form-select" aria-label="Default select example" name="produk">
                                    <option selected>Pilih Produk</option>
                                    <?php foreach ($produk as $p): ?>
                                        <option value="<?= $p['id_produk'] ?>"><?php echo $p['nama_produk'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Liter Produk:</label>
                                <input type="number" name="jumlah" class="form-control" style="width: 300px;" value = 0>
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