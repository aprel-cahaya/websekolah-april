<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sekolah";

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass,$db);

// Cek Koneksi
if(!$koneksi){
    die("KOneksi gagal: ". mysqli_connect_error());
}

?>