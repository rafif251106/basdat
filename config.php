<?php
function connection()
{
    $conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>