<?php
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? "";
    $query = "SELECT * FROM pengiriman WHERE id_kendaraan = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data tidak dapat dihapus karena terhubung dengan tabel lain!!!'); window.location='../../kendaraan.php'</script>";
    } else {
        $query = "DELETE FROM kendaraan WHERE id_kendaraan = '$id'";
        if (mysqli_query($conn, $query)) {
            header("location:../../kendaraan.php");
        } 
    }
}
?>
