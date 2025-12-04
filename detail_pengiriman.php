<?php
include_once "./auth.php";
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");

$id = $_GET['id'];
$query = "SELECT * FROM pengiriman WHERE id_pengiriman = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$tanggal = $data['tanggal_kirim'];
$status = $data['status_pengiriman'];

$idt = $data['id_terminal'];
$query = "SELECT t.id_terminal,t.nama_terminal FROM terminal t WHERE id_terminal = '$idt'";
$result = mysqli_query($conn, $query);
$tselect = mysqli_fetch_assoc($result);

$query = "SELECT t.id_terminal,t.nama_terminal FROM terminal t WHERE id_terminal != '$idt'";
$result = mysqli_query($conn, $query);
$terminal = mysqli_fetch_all($result, MYSQLI_ASSOC);

$ids = $data['id_spbu'];
$query = "SELECT s.id_spbu,s.nama_spbu FROM spbu s WHERE id_spbu = '$ids'";
$result = mysqli_query($conn, $query);
$sselect = mysqli_fetch_assoc($result);

$query = "SELECT s.id_spbu,s.nama_spbu FROM spbu s WHERE id_spbu != '$ids'";
$result = mysqli_query($conn, $query);
$spbu = mysqli_fetch_all($result, MYSQLI_ASSOC);

$idso = $data['id_sopir'];
$query = "SELECT s.id_sopir,s.nama_sopir FROM sopir s WHERE id_sopir = '$idso'";
$result = mysqli_query($conn, $query);
$soselect = mysqli_fetch_assoc($result);

$query = "SELECT s.id_sopir,s.nama_sopir FROM sopir s WHERE id_sopir != '$idso'";
$result = mysqli_query($conn, $query);
$sopir = mysqli_fetch_all($result, MYSQLI_ASSOC);

$idk = $data['id_kendaraan'];
$query = "SELECT k.id_kendaraan,k.plat_nomor FROM kendaraan k WHERE id_kendaraan = '$idk'";
$result = mysqli_query($conn, $query);
$kselect = mysqli_fetch_assoc($result);

$query = "SELECT k.id_kendaraan,k.plat_nomor FROM kendaraan k WHERE id_kendaraan != '$idk'";
$result = mysqli_query($conn, $query);
$kendaraan = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT dp.id_pengiriman,dp.id_produk,pb.nama_produk,dp.jumlah_liter_produk FROM detail_pengiriman dp join pengiriman p ON p.id_pengiriman = dp.id_pengiriman JOIN produk_bbm pb ON pb.id_produk = dp.id_produk WHERE dp.id_pengiriman = '$id'";
$result = mysqli_query($conn, $query);
$detail_p = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['kembali'])) {
    header("location:./pengiriman.php");
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
    <link rel="stylesheet" href="./css/navbar.css">
</head>

<body>
    <?php require_once "./include/navbar.php" ?>
    <h2 style="text-align: center;">Tambah Data Pengiriman</h2>
    <form action="./detail_pengiriman.php" method="post">
        <button type="submit" name="kembali" class="btn btn-danger ms-5">Kembali</button>
    </form>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <form action="edit.php?id=<?= $id ?>" method="post" style="padding:10px">
            <table style="width: 1000px;">
                <tr>
                    <td colspan="2">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">ID Pengiriman:</label>
                            <input type="text" name="tanggal" class="form-control" value="<?= $id ?>" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Kirim:</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>" disabled>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pengiriman:</label>
                            <select class="form-select" aria-label="Default select example" name="status" disabled>
                                <?php if ($status == "dalam perjalanan"): ?>
                                    <option value="<?= $status ?>"><?php echo ucwords($status) ?></option>
                                    <option value="tiba">Tiba</option>
                                <?php elseif ($status == "tiba"): ?>
                                    <option value="<?= $status ?>"><?php echo ucwords($status) ?></option>
                                    <option value="dalam perjalanan">Dalam Perjalanan</option>
                                <?php endif ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mb-3">
                            <label for="terminal" class="form-label">Terminal:</label>
                            <select class="form-select" aria-label="Default select example" name="terminal" disabled>
                                <option value="<?= $tselect['id_terminal'] ?>"><?php echo $tselect['nama_terminal'] ?></option>
                                <?php foreach ($terminal as $t): ?>
                                    <option value="<?= $t['id_terminal'] ?>"><?php echo $t['nama_terminal'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3">
                            <label for="spbu" class="form-label">SPBU:</label>
                            <select class="form-select" aria-label="Default select example" name="spbu" disabled>
                                <option value="<?= $sselect['id_spbu'] ?>"><?php echo $sselect['nama_spbu'] ?></option>
                                <?php foreach ($spbu as $s): ?>
                                    <option value="<?= $s['id_spbu'] ?>"><?php echo $s['nama_spbu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <label for="sopir" class="form-label">Sopir:</label>
                            <select class="form-select" aria-label="Default select example" name="sopir" disabled>
                                <option value="<?= $soselect['id_sopir'] ?>"><?php echo $soselect['nama_sopir'] ?></option>
                                <?php foreach ($sopir as $s): ?>
                                    <option value="<?= $s['id_sopir'] ?>"><?php echo $s['nama_sopir'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mb-3">
                            <label for="kendaraan" class="form-label">Kendaraan:</label>
                            <select class="form-select" aria-label="Default select example" name="kendaraan" disabled>
                                <option value="<?= $kselect['id_kendaraan'] ?>"><?php echo $kselect['plat_nomor'] ?></option>
                                <?php foreach ($kendaraan as $k): ?>
                                    <option value="<?= $k['id_kendaraan'] ?>"><?php echo $k['plat_nomor'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="container">
        <h2>Pengiriman</h2>
        <a href="./crud/detail_pengiriman/tambah.php?id=<?= $id ?>" class="btn btn-primary mb-4">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
            <tr class="table-dark">
                <th>ID Pengiriman</th>
                <th>Nama Produk</th>
                <th>Jumlah Liter</th>
                <th>Action</th>
            </tr>
            <?php foreach ($detail_p as $dp): ?>
                <tr>
                    <td><?php echo $dp['id_pengiriman'] ?></td>
                    <td><?php echo $dp['nama_produk'] ?></td>
                    <td><?php echo $dp['jumlah_liter_produk'] ?></td>
                    <td>
                        <a href="./crud/detail_pengiriman/delete.php?id_pengiriman=<?= $dp['id_pengiriman'] ?>&id_produk=<?= $dp['id_produk'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/detail_pengiriman/edit.php?id_pengiriman=<?= $dp['id_pengiriman'] ?>&id_produk=<?= $dp['id_produk'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>