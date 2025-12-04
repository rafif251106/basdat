<?php
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? "";
    $query = "SELECT * FROM detail_pengiriman WHERE id_pengiriman = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data tidak dapat dihapus karena terhubung dengan tabel lain!!!'); window.location='../../pengiriman.php'</script>";
    } else {
        $query = "DELETE FROM pengiriman WHERE id_pengiriman = '$id'";
        if (mysqli_query($conn, $query)) {
            header("location:../../pengiriman.php");
        } 
    }
}
?>
