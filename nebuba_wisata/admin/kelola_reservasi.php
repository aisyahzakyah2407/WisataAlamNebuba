<?php 
session_start();
include '../includes/header.php';
// Fungsi untuk mengirim notifikasi
function sendNotification($telepon, $message) {
    // Ini contoh menggunakan link WhatsApp, bisa diganti dengan API WA Gateway jika ada
    $wa_link = "https://api.whatsapp.com/send?phone=".$telepon."&text=".urlencode($message);
    return $wa_link;
}
include '../config/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Update status reservasi
if (isset($_GET['konfirmasi'])) {
    $id = $_GET['konfirmasi'];
    $query = "UPDATE reservasi SET status='Confirmed' WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['success'] = "Reservasi berhasil dikonfirmasi";
    header("Location: kelola_reservasi.php");
    exit;
}

if (isset($_GET['tolak'])) {
    $id = $_GET['tolak'];
    $query = "UPDATE reservasi SET status='Rejected' WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['success'] = "Reservasi berhasil ditolak";
    header("Location: kelola_reservasi.php");
    exit;
}

// Hapus reservasi
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM reservasi WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['success'] = "Reservasi berhasil dihapus";
    header("Location: kelola_reservasi.php");
    exit;
}

// Ambil data reservasi - DIUBAH: Urutkan berdasarkan ID DESC dan Tanggal DESC
$query = "SELECT * FROM reservasi ORDER BY id DESC, tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container admin-dashboard my-5">
    <h1 class="text-center mb-5">Kelola Reservasi</h1>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']) ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Daftar Reservasi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while($reservasi = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($reservasi['nama']) ?></td>
                            <td><?= htmlspecialchars($reservasi['telepon']) ?></td>
                            <td><?= htmlspecialchars($reservasi['jenis']) ?></td>
                            <td><?= date('d/m/Y', strtotime($reservasi['tanggal'])) ?></td>
                            <td><?= htmlspecialchars($reservasi['jumlah']) ?></td>
                            <td>
                                <?php if($reservasi['status'] == 'Confirmed'): ?>
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                <?php elseif($reservasi['status'] == 'Rejected'): ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($reservasi['status'] == 'Pending'): ?>
                                    <a href="kelola_reservasi.php?konfirmasi=<?= $reservasi['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda Yakin ingin Konfirmasi?')" >Konfirmasi</a>
                                    <a href="kelola_reservasi.php?tolak=<?= $reservasi['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin ingin Tolak?')">Tolak</a>
                                <?php endif; ?>
                                <a href="kelola_reservasi.php?hapus=<?= $reservasi['id'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Apakah Anda Yakin ingin menghapus?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $reservasi['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Reservasi #<?= $reservasi['id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="crud_reservasi.php">
                                            <input type="hidden" name="id" value="<?= $reservasi['id'] ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($reservasi['nama']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Telepon</label>
                                                <input type="text" class="form-control" name="telepon" value="<?= htmlspecialchars($reservasi['telepon']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jenis</label>
                                                <select class="form-select" name="jenis" required>
                                                    <option value="Tiket Masuk" <?= $reservasi['jenis'] == 'Tiket Masuk' ? 'selected' : '' ?>>Tiket Masuk</option>
                                                    <option value="Penginapan" <?= $reservasi['jenis'] == 'Penginapan' ? 'selected' : '' ?>>Penginapan</option>
                                                    <option value="Vila" <?= $reservasi['jenis'] == 'Vila' ? 'selected' : '' ?>>Vila</option>
                                                    <option value="Tenda" <?= $reservasi['jenis'] == 'Tenda' ? 'selected' : '' ?>>Tenda</option>
                                                </select>
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

<?php include '../includes/footer.php'; ?>