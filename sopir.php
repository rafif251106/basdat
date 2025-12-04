<?php
include_once "./auth.php";
include_once "./authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT * FROM sopir";
$result = mysqli_query($conn, $query);
$sopir = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">

</head>

<body>
    <?php
    require_once __DIR__ . "/include/navbar.php";
    ?>
    <div class="container">
        <h2>Sopir</h2>
        <a href="./crud/sopir/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
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
    </div>
</body>

</html>