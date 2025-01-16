<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Masukkan Secret Key Anda di sini
    $secretKey = "YOUR_SECRET_KEY";

    // Ambil token reCAPTCHA dari form
    $responseKey = $_POST['g-recaptcha-response'];

    // Kirim permintaan ke Google untuk memvalidasi reCAPTCHA
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response = file_get_contents($url);
    $responseData = json_decode($response);

    // Periksa apakah reCAPTCHA berhasil diverifikasi
    if (!$responseData->success) {
        die("Verifikasi reCAPTCHA gagal. Silakan coba lagi.");
    }

    // Koneksi ke database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "hubungi_kami_db";

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $organisasi = $conn->real_escape_string($_POST['organization']);
    $telepon = $conn->real_escape_string($_POST['phone']);
    $pesan = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO pesan (nama, email, organisasi, telepon, pesan) VALUES ('$nama', '$email', '$organisasi', '$telepon', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>Pesan Anda berhasil dikirim!</h1>";
        echo "<p><a href='hubungkami.html'>Kembali ke form</a></p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
