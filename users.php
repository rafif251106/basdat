<?php
include_once "./auth.php";
include_once "./authadmin.php";

$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
$query = "SELECT * FROM `users`";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama = $_POST['nama'] ?? "";
if (isset($_POST['cari']) && !empty($nama)) {
    $query = "SELECT * FROM `users` WHERE nama like '%$nama%'";
    $result = mysqli_query($conn, $query);
    $usersc = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $usersc[] = $row;
    }
}
?>

<head>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        .users {
            display: none;
        }
        <?php endif; ?>
    </style>
</head>

<body>
    <?php
    require_once __DIR__ . "/include/navbar.php";
    ?>
    <div class="container">
        <h2>Users</h2>
        <form action="users.php" method="post">
            <input type="search" name="nama" class="form-control" style="width: 250px; display: inline-block;" placeholder="Masukkan nama" list="users">
            <button type="submit" name="cari" class="btn btn-primary mb-2">Search</button>
            <button type="submit" name="reset" class="btn btn-danger mb-2" onclick="<?= header("location:users.php") ?>">Reset</button>
        </form>
        <a href="./crud/users/tambah.php" class="btn btn-primary">Tambah Data</a>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary users">
            <tr class="table-dark">
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u['id'] ?></td>
                    <td><?php echo $u['username'] ?></td>
                    <td><?php echo $u['password'] ?></td>
                    <td><?php echo $u['nama'] ?></td>
                    <td><?php echo $u['level'] ?></td>
                    <td>
                        <a href="./crud/users/delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                        <a href="./crud/users/edit.php?id=<?= $u['id'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if (isset($_POST['cari']) && !empty($nama)): ?>
        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
            <tr class="table-dark">
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
            <?php foreach ($usersc as $u): ?>
            <tr>
                <td><?php echo $u['id'] ?></td>
                <td><?php echo $u['username'] ?></td>
                <td><?php echo $u['password'] ?></td>
                <td><?php echo $u['nama'] ?></td>
                <td><?php echo $u['level'] ?></td>
                <td>
                    <a href="./crud/users/delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class=" btn btn-danger">Delete</a>
                    <a href="./crud/users/edit.php?id=<?= $u['id'] ?>" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</body>

</html>