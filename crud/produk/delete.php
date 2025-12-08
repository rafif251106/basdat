<?php
include_once "../../config.php";
$conn = connection();
if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? "";
    $query = "SELECT * FROM detail_pengiriman WHERE id_produk = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data tidak dapat dihapus karena terhubung dengan tabel lain!!!'); window.location='../../produk.php'</script>";
    } else {
        $query = "DELETE FROM produk_bbm WHERE id_produk = '$id'";
        if (mysqli_query($conn, $query)) {
            header("location:../../produk.php");
        }
    }
}
?>
