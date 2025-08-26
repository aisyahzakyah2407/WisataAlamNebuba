<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// EDIT RESERVASI
if (isset($_POST['edit'])) {
    try {
        $id = (int)$_POST['id'];
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
        $jenis = mysqli_real_escape_string($conn, $_POST['jenis']);
        
        if (empty($nama) || empty($telepon) || empty($jenis)) {
            throw new Exception("Data penting tidak boleh kosong");
        }

        $query = "UPDATE reservasi SET 
                    nama = ?,
                    telepon = ?,
                    jenis = ?
                  WHERE id = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nama, $telepon, $jenis, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Reservasi berhasil diperbarui";
        } else {
            throw new Exception("Gagal memperbarui reservasi");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: ../admin/kelola_reservasi.php");
    exit;
}
?>