<?php
include_once "../../auth.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_POST['batal'])) {
    header("location:../../pengiriman.php");
}
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
// var_dump($kendaraan);

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $tanggal = $_POST['tanggal'] ?? "";
    $status = $_POST['status'] ?? "";
    $terminal = $_POST['terminal'] ?? "";
    $spbu = $_POST['spbu'] ?? "";
    $sopir = $_POST['sopir'] ?? "";
    $kendaraan = $_POST['kendaraan'] ?? "";

    $query = "UPDATE pengiriman SET tanggal_kirim = ?,status_pengiriman = ?,id_terminal = ?,id_spbu = ?,id_sopir = ?,id_kendaraan = ? WHERE id_pengiriman = ?";
    $prepare = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($prepare,"ssiiiii",$tanggal,$status,$terminal,$spbu,$sopir,$kendaraan,$id);
    if (mysqli_stmt_execute($prepare)) {
        header("location:../../pengiriman.php");
    } else {
        echo "data gagal diupdate";
    }
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
    <h2 style="text-align: center;">Tambah Data Pengiriman</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="edit.php?id=<?= $id ?>" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Kirim:</label>
                                <input type="date" name="tanggal" class="form-control" style="width: 300px;" value="<?= $tanggal ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Pengiriman:</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="terjadwal" <?php if($status == "terjadwal") echo "selected" ?>>Terjadwal</option>
                                    <option value="perjalanan" <?php if($status == "perjalanan") echo "selected" ?>>Dalam Perjalanan</option>
                                    <option value="selesai" <?php if($status == "selesai") echo "selected" ?>>Selesai</option>
                                    <option value="dibatalkan" <?php if($status == "dibatalkan") echo "selected" ?>>Dibatalkan</option>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="terminal" class="form-label">Terminal:</label>
                                <select class="form-select" aria-label="Default select example" name="terminal">
                                    <option value="<?= $tselect['id_terminal'] ?>"><?php echo $tselect['nama_terminal'] ?></option>
                                    <?php foreach ($terminal as $t): ?>
                                        <option value="<?= $t['id_terminal'] ?>"><?php echo $t['nama_terminal'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="spbu" class="form-label">SPBU:</label>
                                <select class="form-select" aria-label="Default select example" name="spbu">
                                    <option value="<?= $sselect['id_spbu'] ?>"><?php echo $sselect['nama_spbu'] ?></option>
                                    <?php foreach ($spbu as $s): ?>
                                        <option value="<?= $s['id_spbu'] ?>"><?php echo $s['nama_spbu'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="sopir" class="form-label">Sopir:</label>
                                <select class="form-select" aria-label="Default select example" name="sopir">
                                    <option value="<?= $soselect['id_sopir'] ?>"><?php echo $soselect['nama_sopir'] ?></option>
                                    <?php foreach ($sopir as $s): ?>
                                        <option value="<?= $s['id_sopir'] ?>"><?php echo $s['nama_sopir'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="kendaraan" class="form-label">Kendaraan:</label>
                                <select class="form-select" aria-label="Default select example" name="kendaraan">
                                    <option value="<?= $kselect['id_kendaraan'] ?>"><?php echo $kselect['plat_nomor'] ?></option>
                                    <?php foreach ($kendaraan as $k): ?>
                                        <option value="<?= $k['id_kendaraan'] ?>"><?php echo $k['plat_nomor'] ?></option>
                                    <?php endforeach; ?>
                                </select>
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