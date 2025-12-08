<?php
include_once "../../auth.php";
include_once "../../authadmin.php";
include_once "../../config.php";

$conn = connection();
if (isset($_POST['batal'])) {
    header("location:../../sopir.php");
}
$id = $_GET['id'] ?? "";
$query = "SELECT * FROM sopir WHERE id_sopir = '$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);


$nama = $data['nama_sopir'] ?? "";
$telepon = $data['no_hp'] ?? "";
$sim = $data['no_sim'] ?? "";
if (isset($_POST['update'])) {
    $nama = $_POST['nama'] ?? "";
    $telepon = $_POST['telepon'] ?? "";
    $sim = $_POST['sim'] ?? "";

    $query = "UPDATE sopir SET nama_sopir = '$nama',no_hp = '$telepon',no_sim = '$sim' WHERE id_sopir = '$id'";
    if (mysqli_query($conn, $query)) {
        header("location:../../sopir.php");
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
    <h2 style="text-align: center;">Edit Data Sopir</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="edit.php?id=<?= $id ?>" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Sopir:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;" value="<?= $nama ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">No Telepon:</label>
                                <input type="text" name="telepon" class="form-control" style="width: 300px;" value="<?= $telepon ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="sim" class="form-label">No Sim:</label>
                                <input type="text" name="sim" class="form-control" style="width: 300px;" value="<?= $sim ?>">
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