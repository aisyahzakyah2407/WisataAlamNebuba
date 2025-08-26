<?php 
session_start();
// Handle semua CRUD operations di file yang sama
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/nebuba_wisata/config/database.php';
    
    if (isset($_POST['tambah'])) {
        // Kode untuk tambah informasi
    }
    
    if (isset($_POST['edit'])) {
        // Kode untuk edit informasi
    }
    
    // Setelah proses, redirect ke halaman ini lagi
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
include '../includes/header.php';
include '../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$query = "SELECT * FROM informasi ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container admin-dashboard my-5">
    <h1 class="text-center mb-5">Kelola Informasi Wisata</h1>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Informasi Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="crud_informasi.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Informasi</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Informasi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/jpeg,image/png" required>
                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                </div>
                <button type="submit" name="tambah" class="btn btn-success">Tambah Informasi</button>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Daftar Informasi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while($informasi = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($informasi['judul']) ?></td>
                            <td><?= date('d/m/Y', strtotime($informasi['tanggal'])) ?></td>
                            <td><img src="../assets/img/informasi/<?= $informasi['gambar'] ?>" width="100" class="img-thumbnail"></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $informasi['id'] ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href="crud_informasi.php?hapus=<?= $informasi['id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $informasi['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Informasi<?= $informasi['id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="crud_informasi.php" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $informasi['id'] ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Judul</label>
                                                <input type="text" class="form-control" name="judul" value="<?= htmlspecialchars($informasi['judul']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Isi</label>
                                                <textarea class="form-control" name="isi" rows="5" required><?= htmlspecialchars($informasi['isi']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Gambar Baru (Opsional)</label>
                                                <input type="file" class="form-control" name="gambar" accept="image/jpeg,image/png">
                                                <small class="text-muted">Format: JPG, PNG. Maks 2MB</small>
                                                <div class="mt-2">
                                                    <img src="../assets/img/informasi/<?= $informasi['gambar'] ?>" width="150" class="img-thumbnail">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

<script>
// Validasi form informasi
document.getElementById('formInformasi').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('gambar');
    const maxSize = 2 * 1024 * 1024; // 2MB
    
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            alert('Hanya file JPG/PNG yang diizinkan');
            e.preventDefault();
            return false;
        }
        
        if (file.size > maxSize) {
            alert('Ukuran file maksimal 2MB');
            e.preventDefault();
            return false;
        }
    }
    
    return true;
});
</script>

<?php include '../includes/footer.php'; ?>