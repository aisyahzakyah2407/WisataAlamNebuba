<?php 
session_start();
include '../includes/header.php';
include '../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil data galeri
$query = "SELECT * FROM galeri";
$result = mysqli_query($conn, $query);
?>

<div class="container admin-dashboard my-5">
    <h1 class="text-center mb-5">Kelola Galeri Wisata</h1>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Gambar Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="../crud_galeri.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Gambar</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" required>
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                </div>
                <button type="submit" name="tambah" class="btn btn-success">Tambah Gambar</button>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Daftar Galeri</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while($galeri = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><img src="../assets/img/galeri/<?= $galeri['gambar'] ?>" width="100"></td>
                            <td><?= substr($galeri['keterangan'], 0, 50) ?>...</td>
                            <td>
                                 <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $galeri['id'] ?>">
        Edit
    </button>
    <a href="../crud_galeri.php?hapus=<?= $galeri['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
        Hapus
    </a>
                            </td>
                        </tr>
                        
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $galeri['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Galeri #<?= $galeri['id'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/nebuba_wisata/crud_galeri.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $galeri['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3" required><?= htmlspecialchars($galeri['keterangan']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Baru (Opsional)</label>
                        <input type="file" class="form-control" name="gambar" accept="image/jpeg,image/png">
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                        <div class="mt-2">
                            <p>Gambar saat ini:</p>
                            <img src="../assets/img/galeri/<?= htmlspecialchars($galeri['gambar']) ?>" width="100%" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
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

<?php include '../includes/footer.php'; ?>