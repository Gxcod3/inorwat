<?php
$servername = "localhost";   // host lokal
$username   = "root";        // default user XAMPP
$password   = "";            // default password kosong
$dbname     = "inorwat_register"; // sesuai nama database di phpMyAdmin

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
