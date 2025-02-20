<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sekolah";

$koneksi = mysqli_connect($host, $user, $pass,$db);

if(!$koneksi){
    die("KOneksi gagal: ". mysqli_connect_error());
}

?>