<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "wisata_nebuba";

// Aktifkan error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $username, $password, $database);
    
    if (!$conn) {
        throw new Exception("Koneksi database gagal: " . mysqli_connect_error());
    }
    
    // Set charset
    mysqli_set_charset($conn, "utf8mb4");
    
} catch (Exception $e) {
    die("ERROR KONEKSI DATABASE: " . $e->getMessage());
}
?>