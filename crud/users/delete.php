<?php
include_once "../../config.php";
$conn = connection();
if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? "";
    $query = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("location:../../users.php");
    } else {
        echo "Data gagal dihapus";
    }
}
