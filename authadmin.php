<?php
if($_SESSION["level"] != "admin"){
    header("location:/basdat/homepage.php");
}
?>