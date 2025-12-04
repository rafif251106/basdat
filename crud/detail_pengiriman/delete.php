<?php
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_GET['id_pengiriman']) && isset($_GET['id_produk'])) {
    $id_pengiriman = $_GET['id_pengiriman'] ?? "";
    $id_produk = $_GET['id_produk'] ?? "";
    $query = "DELETE FROM detail_pengiriman WHERE id_pengiriman = '$id_pengiriman' && id_produk = '$id_produk'";
    if (mysqli_query($conn, $query)) {
        header("location:../../detail_pengiriman.php?id=".$id_pengiriman);
    } else {
        echo "Data gagal dihapus";
    }
}
?>