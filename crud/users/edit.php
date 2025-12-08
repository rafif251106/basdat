<?php
include_once "../../auth.php";
include_once "../../config.php";
checkLogin();
checkAdmin();

$conn = connection();
if (isset($_POST['batal'])) {
    header("location:../../users.php");
}

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$username = $data['username'] ?? "";
$password = $data['password'] ?? "";
$nama = $data['nama'] ?? "";
$level = $data['level'] ?? "";
if (isset($_POST['update'])) {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    $nama = $_POST['nama'] ?? "";
    $level = $_POST['level'] ?? "";

    $query = "UPDATE users SET username = ?,`password` = ?,nama = ?,`level` = ? WHERE id = ?";
    $prepare = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($prepare, "ssssi", $username, $password, $nama, $level, $id);
    if (mysqli_stmt_execute($prepare)) {
        header("location:../../users.php");
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
    <link rel="stylesheet" href="../../css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/navbar.css">
</head>

<body>
    <?php require_once "../../include/navbar.php" ?>
    <div class="container">
        <h2 style="text-align: center;">Edit Data Users</h2>
    </div>
    <div class="container-fluid" style="display: flex; justify-content:center;">
        <div class="card">
            <div class="card-body">
                <form action="edit.php?id=<?= $id ?>" method="post" style="padding:10px">
                    <table class="w-100">
                        <tr>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" style="width: 300px;" value="<?= $username ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="text" name="password" class="form-control" style="width: 300px;" value="<?= $password ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" class="form-control" style="width: 300px;" value="<?= $nama ?>">
                            </div>
                        </tr>
                        <tr>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level:</label>
                                <select class="form-select" aria-label="Default select example" name="level">
                                    <?php if ($level == "admin"): ?>
                                        <option value="<?= $level ?>"><?php echo ucwords($level) ?></option>
                                        <option value="operator">Operator</option>
                                    <?php elseif ($level == "operator"): ?>
                                        <option value="<?= $level ?>"><?php echo ucwords($level) ?></option>
                                        <option value="admin">Admin</option>
                                    <?php endif ?>
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