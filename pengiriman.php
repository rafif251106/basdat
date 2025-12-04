<?php
include_once "./auth.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT p.id_pengiriman,p.tanggal_kirim,p.status_pengiriman, t.nama_terminal,sp.nama_spbu,s.nama_sopir,k.plat_nomor
FROM pengiriman p JOIN terminal t ON t.id_terminal = p.id_terminal JOIN spbu sp ON sp.id_spbu = p.id_spbu JOIN kendaraan k ON k.id_kendaraan = p.id_kendaraan JOIN sopir s ON s.id_sopir = p.id_sopir";
$result = mysqli_query($conn, $query);
$pengiriman = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <h2>Pengiriman</h2>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
            <tr class="table-dark">
                <th>ID Pengiriman</th>
                <th>Tanggal Kirim</th>
                <th>Status Pengiriman</th>
                <th>Terminal</th>
                <th>SPBU</th>
                <th>Sopir</th>
                <th>Kendaraan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($pengiriman as $p): ?>
                <tr>
                    <td><?php echo $p['id_pengiriman'] ?></td>
                    <td><?php echo $p['tanggal_kirim'] ?></td>
                    <td><?php echo $p['status_pengiriman'] ?></td>
                    <td><?php echo $p['nama_terminal'] ?></td>
                    <td><?php echo $p['nama_spbu'] ?></td>
                    <td><?php echo $p['nama_sopir'] ?></td>
                    <td><?php echo $p['plat_nomor'] ?></td>
                    <td>
                        <a href="./crud/pengiriman/delete.php?id=<?= $p['id_pengiriman'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/pengiriman/edit.php?id=<?= $p['id_pengiriman'] ?>" class="btn btn-primary">Edit</a>
                        <a href="./detail_pengiriman.php?id=<?= $p['id_pengiriman'] ?>" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>