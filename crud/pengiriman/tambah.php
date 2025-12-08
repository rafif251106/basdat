<?php
include_once "../../auth.php";
include_once "../../config.php";

$conn = connection();
if (isset($_POST['batal'])) {
    header("location:../../pengiriman.php");
}
$query = "SELECT t.id_terminal,t.nama_terminal FROM terminal t";
$result = mysqli_query($conn, $query);
$terminal = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT s.id_spbu,s.nama_spbu FROM spbu s";
$result = mysqli_query($conn, $query);
$spbu = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT s.id_sopir,s.nama_sopir FROM sopir s";
$result = mysqli_query($conn, $query);
$sopir = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT k.id_kendaraan,k.plat_nomor FROM kendaraan k WHERE k.status_kendaraan='aktif'";
$result = mysqli_query($conn, $query);
$kendaraan = mysqli_fetch_all($result, MYSQLI_ASSOC);

date_default_timezone_set('Asia/Jakarta');
$tanggal = $_POST['tanggal'] ?? "";
if($tanggal > date('Y-m-d')){
    $status = "terjadwal";

}elseif($tanggal == date('Y-m-d')){
    $status = "perjalanan";
}else{
    $status = "selesai";
}

if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'] ?? "";
    // $status = $_POST['status'] ?? "";
    $terminal = $_POST['terminal'] ?? "";
    $spbu = $_POST['spbu'] ?? "";
    $sopir = $_POST['sopir'] ?? "";
    $kendaraan = $_POST['kendaraan'] ?? "";

    $query = "INSERT INTO pengiriman(tanggal_kirim,status_pengiriman,id_terminal,id_spbu,id_kendaraan,id_sopir)  VALUES 
    ('$tanggal','$status','$terminal','$spbu','$kendaraan','$sopir')";
    if (mysqli_query($conn, $query)) {
        $id = mysqli_insert_id($conn);
        header("location:../detail_pengiriman/tambah.php?id=".$id);
    } else {
        echo "data gagal ditambahkan";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <div class="container">
        <h2 style="text-align: center;">Tambah Data Pengiriman</h2>
    </div>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="tambah.php" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Kirim:</label>
                                <input type="date" name="tanggal" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="terminal" class="form-label">Terminal:</label>
                                <select class="form-select" aria-label="Default select example" name="terminal">
                                    <option selected>Pilih terminal</option>
                                    <?php foreach($terminal as $t):?>
                                        <option value="<?= $t['id_terminal'] ?>"><?php echo $t['nama_terminal']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="spbu" class="form-label">SPBU:</label>
                                <select class="form-select" aria-label="Default select example" name="spbu">
                                    <option selected>Pilih spbu</option>
                                    <?php foreach($spbu as $s):?>
                                        <option value="<?= $s['id_spbu'] ?>"><?php echo $s['nama_spbu']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="sopir" class="form-label">Sopir:</label>
                                <select class="form-select" aria-label="Default select example" name="sopir">
                                    <option selected>Pilih sopir</option>
                                    <?php foreach($sopir as $s):?>
                                        <option value="<?= $s['id_sopir'] ?>"><?php echo $s['nama_sopir']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="kendaraan" class="form-label">Kendaraan:</label>
                                <select class="form-select" aria-label="Default select example" name="kendaraan">
                                    <option selected>Pilih kendaraan</option>
                                    <?php foreach($kendaraan as $k):?>
                                        <option value="<?= $k['id_kendaraan'] ?>"><?php echo $k['plat_nomor']?></option>
                                    <?php endforeach;?>
                                </select>
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