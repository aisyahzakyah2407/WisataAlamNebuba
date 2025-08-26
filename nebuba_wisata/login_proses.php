<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Validasi login
    if ($username == 'admin123' && $password == 'admin321') {
        $_SESSION['username'] = $username;
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Username atau password salah";
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>