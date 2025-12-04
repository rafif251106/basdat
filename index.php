<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:homepage.php");
}

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
function validateusername(&$error, $field)
{
    $conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
    $query = "SELECT * FROM `users` WHERE username = '$field'";
    $result = mysqli_query($conn, $query);
    if (empty($field)) {
        $error['username'] = "Tidak Boleh Kosong";
    } elseif (mysqli_num_rows($result) == 0) {
        $error['username'] = "Username anda salah";
    }
}
function validatepassword(&$error, $field)
{
    $conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
    $query = "SELECT * FROM `users` WHERE `password` = MD5('$field')";
    $result = mysqli_query($conn, $query);
    if (empty($field)) {
        $error['password'] = "Tidak Boleh Kosong";
    } elseif (mysqli_num_rows($result) == 0) {
        $error['password'] = "Password anda salah";
    }
}

$error = [];
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

$hash = hash("MD5", $password);
if (isset($_POST['login'])) {
    validateusername($error, $username);
    validatepassword($error, $password);
    if (count($error) == 0) {
        $query = "SELECT * FROM `users`
        WHERE username = '$username' AND `password` = '$hash'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);


            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];

            header("location:./homepage.php");
        } else {
            header("location:./index.php");
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">

</head>
<h2 style="text-align: center;">Login</h2>
<div class="container-fluid" style="display: flex; justify-content:center;">
    <div class="card p-3 mb-2 bg-secondary text-white">
        <div class="card-body">
            <form method="post" action="index.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="username" value="<?= $username ?? "" ?>">
                    <span class="text-danger"><?php echo $error['username'] ?? "" ?></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?= $password ?? "" ?>">
                    <span class="text-danger"><?php echo $error['password'] ?? "" ?></span>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>
</div>