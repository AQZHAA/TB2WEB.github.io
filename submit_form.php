<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Secret Key dari Google reCAPTCHA
    $secretKey = "6LcXLbkqAAAAAKqQvxcG-lPw5mCnoQRL3a60OsbaY"; // Ganti dengan Secret Key Anda

    // Ambil token reCAPTCHA dari form
    $responseKey = $_POST['g-recaptcha-response'];

    // Kirim permintaan ke Google untuk memvalidasi token
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response = file_get_contents($url);
    $responseData = json_decode($response);

    // Cek hasil validasi
    if (!$responseData->success) {
        die("Verifikasi reCAPTCHA gagal. Silakan coba lagi.");
    }

    // Jika berhasil, lanjutkan proses penyimpanan data
    echo "Verifikasi reCAPTCHA berhasil!";
}
?>
