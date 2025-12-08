<?php
include_once "./auth.php";
include_once "./config.php";
checkLogin();
checkAdmin();

$conn = connection();
$query = "SELECT * FROM spbu";
$result = mysqli_query($conn, $query);
$spbu = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama = $_POST['nama_spbu'] ?? "";
if (isset($_POST['cari']) && !empty($nama)) {
    $query = "SELECT * FROM spbu WHERE nama_spbu LIKE '%$nama%'";
    $result = mysqli_query($conn, $query);
    $spbuc = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $spbuc[] = $row;
    }
}
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        .spbu {
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
        <h2>SPBU</h2>
        <form action="spbu.php" method="post">
            <input type="search" name="nama_spbu" class="form-control" style="width: 250px; display: inline-block;" placeholder="Masukkan nama spbu" list="spbu">
            <button type="submit" name="cari" class="btn btn-primary mb-2">Search</button>
            <button type="submit" name="reset" class="btn btn-danger mb-2" onclick="<?= header("location:spbu.php") ?>">Reset</button>
        </form>
        <a href="./crud/spbu/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary spbu">
            <tr class="table-dark">
                <th>ID SPBU</th>
                <th>Nama SPBU</th>
                <th>Alamat SPBU</th>
                <th>Kota</th>
                <th>Action</th>
            </tr>
            <?php foreach ($spbu as $s): ?>
                <tr>
                    <td><?php echo $s['id_spbu'] ?></td>
                    <td><?php echo $s['nama_spbu'] ?></td>
                    <td><?php echo $s['alamat'] ?></td>
                    <td><?php echo $s['kota'] ?></td>
                    <td>
                        <a href="./crud/spbu/delete.php?id=<?= $s['id_spbu'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/spbu/edit.php?id=<?= $s['id_spbu'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
            <tr class="table-dark">
                <th>ID SPBU</th>
                <th>Nama SPBU</th>
                <th>Alamat SPBU</th>
                <th>Kota</th>
                <th>Action</th>
            </tr>
            <?php foreach ($spbuc as $s): ?>
            <tr>
                <td><?php echo $s['id_spbu'] ?></td>
                <td><?php echo $s['nama_spbu'] ?></td>
                <td><?php echo $s['alamat'] ?></td>
                <td><?php echo $s['kota'] ?></td>
                <td>
                    <a href="./crud/spbu/delete.php?id=<?= $s['id_spbu'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                    <a href="./crud/spbu/edit.php?id=<?= $s['id_spbu'] ?>" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</body>

</html>