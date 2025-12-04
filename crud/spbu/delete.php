<?php
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? "";
    $query = "SELECT * FROM pengiriman WHERE id_spbu = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data tidak dapat dihapus karena terhubung dengan tabel lain!!!'); window.location='../../spbu.php'</script>";
    }else {
        $query = "DELETE FROM spbu WHERE id_spbu = '$id'";
        if (mysqli_query($conn, $query)) {
            header("location:../../spbu.php");
        }
    }
}
?>
