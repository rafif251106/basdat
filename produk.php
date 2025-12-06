<?php
include_once "./auth.php";
include_once "./authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT * FROM produk_bbm";
$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama = $_POST['nama_produk'] ?? "";
if (isset($_POST['cari']) && !empty($nama)) {
    $query = "SELECT * FROM produk_bbm WHERE nama_produk = '$nama'";
    $result = mysqli_query($conn, $query);
    $produkc = mysqli_fetch_assoc($result);
}
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        .produk {
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
        <h2>Produk</h2>
        <form action="produk.php" method="post">
            <input type="search" name="nama_produk" class="form-control" style="width: 250px; display: inline-block;" placeholder="Masukkan nama produk" autocomplete="off" list="produk">
            <datalist id="produk">
                <?php foreach ($produk as $p): ?>
                    <option value="<?php echo $p['nama_produk']; ?>">
                <?php endforeach; ?>
            </datalist>
            <button type="submit" name="cari" class="btn btn-primary mb-2">Search</button>
            <button type="submit" name="reset" class="btn btn-danger mb-2" onclick="<?= header("location:produk.php") ?>">Reset</button>
        </form>
        <a href="./crud/produk/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary produk">
            <tr class="table-dark">
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jenis BBM</th>
                <th>Harga per Liter</th>
                <th>Action</th>
            </tr>
            <?php foreach ($produk as $p): ?>
                <tr>
                    <td><?php echo $p['id_produk'] ?></td>
                    <td><?php echo $p['nama_produk'] ?></td>
                    <td><?php echo $p['jenis_bbm'] ?></td>
                    <td><?php echo $p['harga_per_liter'] ?></td>
                    <td>
                        <a href="./crud/produk/delete.php?id=<?= $p['id_produk'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/produk/edit.php?id=<?= $p['id_produk'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if (isset($_POST['cari']) && !empty($_POST['nama_produk'])): ?>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
            <tr class="table-dark">
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jenis BBM</th>
                <th>Harga per Liter</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><?php echo $produkc['id_produk'] ?></td>
                <td><?php echo $produkc['nama_produk'] ?></td>
                <td><?php echo $produkc['jenis_bbm'] ?></td>
                <td><?php echo $produkc['harga_per_liter'] ?></td>
                <td>
                    <a href="./crud/produk/delete.php?id=<?= $produkc['id_produk'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                    <a href="./crud/produk/edit.php?id=<?= $produkc['id_produk'] ?>" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        </table>
        <?php endif; ?>
    </div>
</body>

</html>