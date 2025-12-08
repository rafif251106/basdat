<?php
include_once "../../auth.php";
include_once "../../config.php";
checkLogin();
checkAdmin();

$conn = connection();
if(isset($_GET['id'])){
    $id = $_GET['id'] ?? "";
    $query = "SELECT * FROM pengiriman WHERE id_terminal = '$id'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('Data tidak dapat dihapus karena terhubung dengan tabel lain!!!'); window.location='../../terminal.php'</script>";
    }else{
        $query = "DELETE FROM terminal WHERE id_terminal = '$id'";
        if(mysqli_query($conn,$query)){
            header("location:../../terminal.php");
        }
    }
}
?>