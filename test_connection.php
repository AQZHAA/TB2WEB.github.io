<?php
$host = "localhost";
$user = "root"; // Default username
$password = ""; // Default password
$database = "hubungi_kami_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi ke database berhasil!";
$conn->close();
?>
