<?php
session_start();
// Gunakan __DIR__ untuk path absolut
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil data kontak utama
$query = "SELECT * FROM kontak WHERE nama IS NULL LIMIT 1";
$result = mysqli_query($conn, $query);
$kontak = mysqli_fetch_assoc($result);

// Ambil pesan masuk
$query_pesan = "SELECT * FROM kontak WHERE nama IS NOT NULL ORDER BY tanggal DESC";
$result_pesan = mysqli_query($conn, $query_pesan);
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Kelola Kontak Wisata</h1>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Informasi Kontak</h5>
                </div>
                <div class="card-body">
                    <!-- Form action disesuaikan -->
                    <form method="POST" action="crud_kontak.php" id="formKontak">
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?= htmlspecialchars($kontak['alamat'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="<?= htmlspecialchars($kontak['telepon'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor WhatsApp (tanpa +62)</label>
                            <input type="text" class="form-control" name="whatsapp" value="<?= htmlspecialchars($kontak['whatsapp'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username Instagram</label>
                            <input type="text" class="form-control" name="instagram" value="<?= htmlspecialchars($kontak['instagram'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="<?= htmlspecialchars($kontak['facebook'] ?? '') ?>" required>
                        </div>
                        <input type="hidden" name="jam_operasional" value="24 Jam Setiap Hari">
                        <button type="submit" name="update_kontak" class="btn btn-success">Simpan Perubahan</button>
                        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Pesan Masuk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                    <th>Tanggal</th>
                                    <th>Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($pesan = mysqli_fetch_assoc($result_pesan)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pesan['nama']) ?></td>
                                    <td><?= htmlspecialchars($pesan['telepon']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($pesan['tanggal'])) ?></td>
                                    <td><?= htmlspecialchars($pesan['pesan']) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPesanModal<?= $pesan['id'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <!-- Link hapus disesuaikan -->
                                        <a href="crud_kontak.php?hapus=<?= $pesan['id'] ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Hapus pesan ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                
                                <!-- Modal Edit Pesan -->
                                <div class="modal fade" id="editPesanModal<?= $pesan['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Pesan dari <?= htmlspecialchars($pesan['nama']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form action disesuaikan -->
                                                <form method="POST" action="crud_kontak.php">
                                                    <input type="hidden" name="id" value="<?= $pesan['id'] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($pesan['nama']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Telepon</label>
                                                        <input type="text" class="form-control" name="telepon" value="<?= htmlspecialchars($pesan['telepon']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Pesan</label>
                                                        <textarea class="form-control" name="pesan" rows="3" required><?= htmlspecialchars($pesan['pesan']) ?></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="edit_pesan" class="btn btn-primary">Simpan</button>
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
        </div>
    </div>
</div>

<script>
// Validasi form sebelum submit
document.getElementById('formKontak').addEventListener('submit', function(e) {
    const whatsapp = document.querySelector('input[name="whatsapp"]');
    const telepon = document.querySelector('input[name="telepon"]');
    
    // Validasi nomor telepon
    if (!/^[0-9]+$/.test(telepon.value)) {
        alert('Nomor telepon hanya boleh mengandung angka');
        e.preventDefault();
        return false;
    }
    
    // Validasi nomor WhatsApp
    if (!/^[0-9]+$/.test(whatsapp.value)) {
        alert('Nomor WhatsApp hanya boleh mengandung angka');
        e.preventDefault();
        return false;
    }
    
    return true;
});
</script>

<?php 
include __DIR__ . '/../includes/footer.php'; 
?>