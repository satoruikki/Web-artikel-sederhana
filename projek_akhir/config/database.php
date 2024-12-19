<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_artikel";

$koneksi = new mysqli($host, $user, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
