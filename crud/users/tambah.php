<?php
include_once "../../auth.php";
include_once "../../authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_POST['batal'])) {
    header("location:../../users.php");
}


if (isset($_POST['tambah'])) {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    $nama = $_POST['nama'] ?? "";
    $level = $_POST['level'] ?? "";
    
    $query = "INSERT INTO users(username,`password`,nama,`level`) VALUES 
    (?,MD5(?),?,?)";
    $prepare = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($prepare, "ssss", $username, $password, $nama,$level);
    if (mysqli_stmt_execute($prepare)) {
        header("location:../../users.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <h2 style="text-align: center;">Tambah Data Users</h2>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="tambah.php" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="text" name="password" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level:</label>
                                <select class="form-select" aria-label="Default select example" name="level">
                                    <option selected>Pilih Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
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