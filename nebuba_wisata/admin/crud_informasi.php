<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Fungsi upload gambar
function uploadGambar($file) {
    $targetDir = __DIR__ . "/../assets/img/informasi/";
    $allowed = ['jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB
    
    $filename = basename($file['name']);
    $targetFile = $targetDir . $filename;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Validasi
    if (!in_array($fileType, $allowed)) {
        throw new Exception("Hanya file JPG, JPEG, PNG yang diizinkan");
    }
    
    if ($file['size'] > $maxSize) {
        throw new Exception("Ukuran file terlalu besar. Maksimal 2MB");
    }
    
    if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
        throw new Exception("Gagal mengupload gambar");
    }
    
    return $filename;
}

// Handle semua operasi CRUD
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['tambah'])) {
            $judul = mysqli_real_escape_string($conn, $_POST['judul']);
            $isi = mysqli_real_escape_string($conn, $_POST['isi']);
            $gambar = uploadGambar($_FILES['gambar']);
            
            $query = "INSERT INTO informasi (judul, isi, gambar, tanggal) VALUES (?, ?, ?, NOW())";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sss", $judul, $isi, $gambar);
            mysqli_stmt_execute($stmt);
            
            $_SESSION['success'] = "Informasi berhasil ditambahkan";
        }
        
        if (isset($_POST['edit'])) {
            $id = (int)$_POST['id'];
            $judul = mysqli_real_escape_string($conn, $_POST['judul']);
            $isi = mysqli_real_escape_string($conn, $_POST['isi']);
            
            if (empty($judul) || empty($isi)) {
                throw new Exception("Judul dan isi tidak boleh kosong");
            }
            
            if (!empty($_FILES['gambar']['name'])) {
                $gambar = uploadGambar($_FILES['gambar']);
                
                // Hapus gambar lama
                $query_old = "SELECT gambar FROM informasi WHERE id=?";
                $stmt_old = mysqli_prepare($conn, $query_old);
                mysqli_stmt_bind_param($stmt_old, "i", $id);
                mysqli_stmt_execute($stmt_old);
                $result = mysqli_stmt_get_result($stmt_old);
                $old_data = mysqli_fetch_assoc($result);
                
                if ($old_data && file_exists(__DIR__ . "/../assets/img/informasi/" . $old_data['gambar'])) {
                    unlink(__DIR__ . "/../assets/img/informasi/" . $old_data['gambar']);
                }
                
                $query = "UPDATE informasi SET judul=?, isi=?, gambar=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sssi", $judul, $isi, $gambar, $id);
            } else {
                $query = "UPDATE informasi SET judul=?, isi=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ssi", $judul, $isi, $id);
            }
            
            mysqli_stmt_execute($stmt);
            $_SESSION['success'] = "Informasi berhasil diperbarui";
        }
    }
    
    if (isset($_GET['hapus'])) {
        $id = (int)$_GET['hapus'];
        
        // Hapus gambar dari server
        $query = "SELECT gambar FROM informasi WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        
        if ($data && file_exists(__DIR__ . "/../assets/img/informasi/" . $data['gambar'])) {
            unlink(__DIR__ . "/../assets/img/informasi/" . $data['gambar']);
        }
        
        // Hapus dari database
        $query = "DELETE FROM informasi WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        
        $_SESSION['success'] = "Informasi berhasil dihapus";
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

header("Location: kelola_informasi.php");
exit;
?>