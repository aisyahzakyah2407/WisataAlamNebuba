<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Fungsi upload gambar
function uploadGambar($file) {
    $targetDir = __DIR__ . "/../assets/img/fasilitas/";
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
            $nama = mysqli_real_escape_string($conn, $_POST['nama']);
            $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
            $gambar = uploadGambar($_FILES['gambar']);
            
            $query = "INSERT INTO fasilitas (nama, keterangan, gambar) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sss", $nama, $keterangan, $gambar);
            mysqli_stmt_execute($stmt);
            
            $_SESSION['success'] = "Fasilitas berhasil ditambahkan";
        }
        
        if (isset($_POST['edit'])) {
            $id = (int)$_POST['id'];
            $nama = mysqli_real_escape_string($conn, $_POST['nama']);
            $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
            
            if (empty($nama) || empty($keterangan)) {
                throw new Exception("Nama dan keterangan tidak boleh kosong");
            }
            
            if (!empty($_FILES['gambar']['name'])) {
                $gambar = uploadGambar($_FILES['gambar']);
                
                // Hapus gambar lama
                $query_old = "SELECT gambar FROM fasilitas WHERE id=?";
                $stmt_old = mysqli_prepare($conn, $query_old);
                mysqli_stmt_bind_param($stmt_old, "i", $id);
                mysqli_stmt_execute($stmt_old);
                $result = mysqli_stmt_get_result($stmt_old);
                $old_data = mysqli_fetch_assoc($result);
                
                if ($old_data && file_exists(__DIR__ . "/../assets/img/fasilitas/" . $old_data['gambar'])) {
                    unlink(__DIR__ . "/../assets/img/fasilitas/" . $old_data['gambar']);
                }
                
                $query = "UPDATE fasilitas SET nama=?, keterangan=?, gambar=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sssi", $nama, $keterangan, $gambar, $id);
            } else {
                $query = "UPDATE fasilitas SET nama=?, keterangan=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ssi", $nama, $keterangan, $id);
            }
            
            mysqli_stmt_execute($stmt);
            $_SESSION['success'] = "Fasilitas berhasil diperbarui";
        }
    }
    
    if (isset($_GET['hapus'])) {
        $id = (int)$_GET['hapus'];
        
        // Hapus gambar dari server
        $query = "SELECT gambar FROM fasilitas WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        
        if ($data && file_exists(__DIR__ . "/../assets/img/fasilitas/" . $data['gambar'])) {
            unlink(__DIR__ . "/../assets/img/fasilitas/" . $data['gambar']);
        }
        
        // Hapus dari database
        $query = "DELETE FROM fasilitas WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        
        $_SESSION['success'] = "Fasilitas berhasil dihapus";
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

header("Location: kelola_fasilitas.php");
exit;
?>