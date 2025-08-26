<?php
session_start();

// =============================================
// KONEKSI DATABASE YANG LEBIH TANGGUH
// =============================================
$base_dir = 'C:/xampp/htdocs/nebuba_wisata'; // PASTIKAN PATH INI SESUAI
$db_path = $base_dir . '/config/database.php';

// DEBUG: Uncomment untuk verifikasi path
// echo "Mengecek: " . $db_path . "<br>";
// echo "File ada: " . (file_exists($db_path) ? 'YA' : 'TIDAK';
// exit;

if (!file_exists($db_path)) {
    die("<h3>Error: File database tidak ditemukan!</h3>
        <b>Path yang benar:</b> " . htmlspecialchars($db_path) . "<br>
        <b>Solusi:</b>
        <ol>
        <li>Pastikan file database.php ada di folder config</li>
        <li>Periksa penulisan path (huruf besar/kecil)</li>
        <li>Untuk XAMPP di Windows, path biasanya: C:/xampp/htdocs/nebuba_wisata/config/database.php</li>
        </ol>");
}

require_once $db_path;

// =============================================
// CEK LOGIN
// =============================================
if (!isset($_SESSION['username'])) {
    $url_redirect = "http://" . $_SERVER['HTTP_HOST'] . "/nebuba_wisata/login.php";
    header("Location: " . $url_redirect);
    exit;
}

// =============================================
// FUNGSI UPLOAD GAMBAR YANG LEBIH BAIK
// =============================================
function uploadGambar($file) {
    $folder_tujuan = 'C:/xampp/htdocs/nebuba_wisata/assets/img/galeri/';
    
    // Buat folder jika belum ada
    if (!file_exists($folder_tujuan)) {
        if (!mkdir($folder_tujuan, 0755, true)) {
            throw new Exception("Gagal membuat folder galeri");
        }
    }

    $format_diterima = ['jpg', 'jpeg', 'png'];
    $ukuran_maksimal = 2 * 1024 * 1024; // 2MB
    
    // Generate nama file unik
    $nama_file = uniqid() . '_' . basename($file['name']);
    $file_tujuan = $folder_tujuan . $nama_file;
    $tipe_file = strtolower(pathinfo($file_tujuan, PATHINFO_EXTENSION));
    
    // Validasi ekstensi file
    if (!in_array($tipe_file, $format_diterima)) {
        throw new Exception("Hanya file JPG, JPEG, PNG yang diperbolehkan");
    }
    
    // Validasi ukuran file
    if (($file['size'] > $ukuran_maksimal)) {
        throw new Exception("Ukuran file melebihi batas 2MB");
    }
    
    // Validasi upload
    if (!move_uploaded_file($file['tmp_name'], $file_tujuan)) {
        throw new Exception("Gagal menyimpan file upload");
    }
    
    return $nama_file;
}

// =============================================
// OPERASI CRUD UTAMA DENGAN ERROR HANDLING
// =============================================
try {
    // TAMBAH DATA GALERI
    if (isset($_POST['tambah'])) {
        $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
        $gambar = uploadGambar($_FILES['gambar']);
        
        $query = "INSERT INTO galeri (keterangan, gambar) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $keterangan, $gambar);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal menyimpan ke database");
        }
        
        $_SESSION['success'] = "Gambar berhasil ditambahkan ke galeri";
    }
    
    // EDIT DATA GALERI
    if (isset($_POST['edit'])) {
        $id = (int)$_POST['id'];
        $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
        
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = uploadGambar($_FILES['gambar']);
            
            // Dapatkan nama gambar lama
            $query = "SELECT gambar FROM galeri WHERE id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data_lama = mysqli_fetch_assoc($result);
            
            // Hapus gambar lama jika ada
            if ($data_lama && !empty($data_lama['gambar'])) {
                $file_lama = 'C:/xampp/htdocs/nebuba_wisata/assets/img/galeri/' . $data_lama['gambar'];
                if (file_exists($file_lama)) {
                    unlink($file_lama);
                }
            }
            
            $query = "UPDATE galeri SET keterangan=?, gambar=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $keterangan, $gambar, $id);
        } else {
            $query = "UPDATE galeri SET keterangan=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $keterangan, $id);
        }
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal memperbarui data");
        }
        
        $_SESSION['success'] = "Perubahan berhasil disimpan";
    }
    
    // HAPUS DATA GALERI
    if (isset($_GET['hapus'])) {
        $id = (int)$_GET['hapus'];
        
        // Dapatkan data gambar
        $query = "SELECT gambar FROM galeri WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        
        // Hapus file gambar jika ada
        if ($data && !empty($data['gambar'])) {
            $file_path = 'C:/xampp/htdocs/nebuba_wisata/assets/img/galeri/' . $data['gambar'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        // Hapus dari database
        $query = "DELETE FROM galeri WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal menghapus data");
        }
        
        $_SESSION['success'] = "Gambar berhasil dihapus";
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

// =============================================
// REDIRECT YANG LEBIH HANDAL
// =============================================
$base_url = "http://" . $_SERVER['HTTP_HOST'];
$redirect_url = $base_url . "/nebuba_wisata/admin/kelola_galeri.php";
header("Location: " . $redirect_url);
exit;
?>