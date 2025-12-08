<?php
session_start();

define("URL_ROOT", "http://localhost/basdat"); // Ganti sesuai dengan nama folder

function checkLogin(){
    if(!isset($_SESSION['id'])){
        header("location:". URL_ROOT. "/login.php");
        exit();
    }
}

function checkAlreadyLogin() {
    if (isset($_SESSION['id'])) {
        header("location:". URL_ROOT. "/index.php");
        exit();
    }
}

function checkAdmin(){
    if($_SESSION["level"] != "admin"){
        header("location:". URL_ROOT. "/index.php");
        exit();
    }
}
?>