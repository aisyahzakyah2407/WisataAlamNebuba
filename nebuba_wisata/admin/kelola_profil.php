<?php 
session_start();
include '../includes/header.php';
include '../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Tambah/Edit Profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    
    // Cek apakah sudah ada data profil
    $check = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
    
    if (mysqli_num_rows($check) > 0) {
        // Update data yang sudah ada
        $query = "UPDATE profil SET judul='$judul', isi='$isi'";
    } else {
        // Tambah data baru
        $query = "INSERT INTO profil (judul, isi) VALUES ('$judul', '$isi')";
    }
    
    mysqli_query($conn, $query);
    header("Location: kelola_profil.php?success=1");
    exit;
}

// Ambil data profil
$query = "SELECT * FROM profil LIMIT 1";
$result = mysqli_query($conn, $query);
$profil = mysqli_fetch_assoc($result);
?>

<div class="container admin-dashboard my-5">
    <h1 class="text-center mb-5">Kelola Profil Wisata</h1>
    
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Profil berhasil diperbarui!</div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Profil</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $profil['judul'] ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Profil</label>
                    <textarea class="form-control" id="isi" name="isi" rows="10" required><?= $profil['isi'] ?? '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>