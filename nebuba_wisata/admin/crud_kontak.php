<?php
session_start();
// Gunakan __DIR__ untuk path absolut
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// UPDATE KONTAK UTAMA
if (isset($_POST['update_kontak'])) {
    try {
        $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
        $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
        $whatsapp = preg_replace('/[^0-9]/', '', $_POST['whatsapp']);
        $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
        $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
        $jam_operasional = "24 Jam Setiap Hari";
        
        if (empty($alamat) || empty($telepon)) {
            throw new Exception("Alamat dan telepon tidak boleh kosong");
        }

        $query = "UPDATE kontak SET 
                    alamat = ?,
                    telepon = ?,
                    whatsapp = ?,
                    instagram = ?,
                    facebook = ?,
                    jam_operasional = ?
                  WHERE nama IS NULL";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $alamat, $telepon, $whatsapp, $instagram, $facebook, $jam_operasional);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal memperbarui kontak");
        }
        
        $_SESSION['success'] = "Kontak berhasil diperbarui";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header("Location: kelola_kontak.php"); // Path relatif ke folder yang sama
    exit;
}

// EDIT PESAN
if (isset($_POST['edit_pesan'])) {
    try {
        $id = (int)$_POST['id'];
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
        $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
        
        if (empty($nama) || empty($telepon) || empty($pesan)) {
            throw new Exception("Semua field harus diisi");
        }

        $query = "UPDATE kontak SET 
                    nama = ?,
                    telepon = ?,
                    pesan = ?,
                    tanggal = NOW()
                  WHERE id = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nama, $telepon, $pesan, $id);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal memperbarui pesan");
        }
        
        $_SESSION['success'] = "Pesan berhasil diperbarui";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header("Location: kelola_kontak.php");
    exit;
}

// HAPUS PESAN
if (isset($_GET['hapus'])) {
    try {
        $id = (int)$_GET['hapus'];
        $query = "DELETE FROM kontak WHERE id = ? AND nama IS NOT NULL";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal menghapus pesan");
        }
        
        $_SESSION['success'] = "Pesan berhasil dihapus";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
    header("Location: kelola_kontak.php");
    exit;
}
?>