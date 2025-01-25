<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "feedback_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Validasi data
    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO feedback (message) VALUES (?)");
        $stmt->bind_param("s", $message);

        if ($stmt->execute()) {
            echo "Saran Anda berhasil dikirim. Terima kasih!";
        } else {
            echo "Terjadi kesalahan: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Mohon tuliskan saran Anda sebelum mengirim.";
    }
}

$conn->close();
?>