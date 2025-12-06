<?php
include_once "./auth.php";
include_once "./authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT * FROM sopir";
$result = mysqli_query($conn, $query);
$sopir = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama = $_POST['nama_sopir'] ?? "";
if (isset($_POST['cari']) && !empty($nama)) {
    $query = "SELECT * FROM sopir WHERE nama_sopir = '$nama'";
    $result = mysqli_query($conn, $query);
    $sopirc = mysqli_fetch_assoc($result);
}

?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        .sopir {
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
        <h2>Sopir</h2>
        <form action="sopir.php" method="post">
            <input type="search" name="nama_sopir" class="form-control" style="width: 250px; display: inline-block;" placeholder="Masukkan nama sopir" autocomplete="off" list="sopir">
            <datalist id="sopir">
                <?php foreach ($sopir as $s): ?>
                    <option value="<?php echo $s['nama_sopir']; ?>">
                    <?php endforeach; ?>
            </datalist>
            <button type="submit" name="cari" class="btn btn-primary mb-2">Search</button>
            <button type="submit" name="reset" class="btn btn-danger mb-2" onclick="<?= header("location:sopir.php") ?>">Reset</button>
        </form>
        <a href="./crud/sopir/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary sopir">
            <tr class="table-dark">
                <th>ID Sopir</th>
                <th>Nama Sopir</th>
                <th>No Telepon</th>
                <th>No Sim</th>
                <th>Action</th>
            </tr>
            <?php foreach ($sopir as $s): ?>
                <tr>
                    <td><?php echo $s['id_sopir'] ?></td>
                    <td><?php echo $s['nama_sopir'] ?></td>
                    <td><?php echo $s['no_hp'] ?></td>
                    <td><?php echo $s['no_sim'] ?></td>
                    <td>
                        <a href="./crud/sopir/delete.php?id=<?= $s['id_sopir'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/sopir/edit.php?id=<?= $s['id_sopir'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary sopirc">
            <tr class="table-dark">
                <th>ID Sopir</th>
                <th>Nama Sopir</th>
                <th>No Telepon</th>
                <th>No Sim</th>
                <th>Action</th>
            </tr>
                <tr>
                    <td><?php echo $sopirc['id_sopir'] ?></td>
                    <td><?php echo $sopirc['nama_sopir'] ?></td>
                    <td><?php echo $sopirc['no_hp'] ?></td>
                    <td><?php echo $sopirc['no_sim'] ?></td>
                    <td>
                        <a href="./crud/sopir/delete.php?id=<?= $sopirc['id_sopir'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/sopir/edit.php?id=<?= $sopirc['id_sopir'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
        </table>
        <?php endif; ?>
    </div>
</body>

</html>