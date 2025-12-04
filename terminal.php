<?php
include_once "./auth.php";
include_once "./authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT * FROM terminal";
$result = mysqli_query($conn, $query);
$terminal = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <h2>Terminal</h2>
        <a href="./crud/terminal/tdterminal.php" class="btn btn-primary">Tambah Data</a>
        <a href="./searchterminal.php" class="btn btn-primary">Search Terminal</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
            <tr class="table-dark">
                <th>ID Terminal</th>
                <th>Nama Terminal</th>
                <th>Lokasi Terminal</th>
                <th>Kapasitas_Penyimpanan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($terminal as $t): ?>
                <tr>
                    <td><?php echo $t['id_terminal'] ?></td>
                    <td><?php echo $t['nama_terminal'] ?></td>
                    <td><?php echo $t['lokasi_terminal'] ?></td>
                    <td><?php echo $t['kapasitas_penyimpanan'] ?></td>
                    <td>
                        <a href="./crud/terminal/delterminal.php?id=<?= $t['id_terminal'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/terminal/edterminal.php?id=<?= $t['id_terminal'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>