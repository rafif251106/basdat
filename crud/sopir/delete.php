<?php
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? "";
    $query = "SELECT * FROM pengiriman WHERE id_sopir = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Data tidak dapat dihapus karena terhubung dengan tabel lain!!!'); window.location='../../sopir.php'</script>";
    } else {
        $query = "DELETE FROM sopir WHERE id_sopir = '$id'";
        if (mysqli_query($conn, $query)) {
            header("location:../../sopir.php");
        }
    }
}
?>
