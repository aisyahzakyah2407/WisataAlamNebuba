<?php
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

$telepon = isset($_GET['telepon']) ? $_GET['telepon'] : '';

if (!empty($telepon)) {
    $query = "SELECT * FROM reservasi WHERE telepon = ? ORDER BY tanggal DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $telepon);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $reservasi = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Status Reservasi</h5>
                        <?php if(!empty($telepon)): ?>
                            <span><i class="fas fa-phone me-1"></i><?= htmlspecialchars($telepon) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card-body">
                    <?php if (!empty($telepon)): ?>
                        <?php if (!empty($reservasi)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservasi as $index => $r): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($r['nama']) ?></td>
                                            <td><?= htmlspecialchars($r['jenis']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($r['tanggal'])) ?></td>
                                            <td><?= htmlspecialchars($r['jumlah']) ?></td>
                                            <td>
                                                <?php if($r['status'] == 'Confirmed'): ?>
                                                    <span class="badge bg-success">Dikonfirmasi</span>
                                                    <div class="mt-2">
                                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                            <i class="fas fa-money-bill-wave me-1"></i> Cara Bayar
                                                        </button>
                                                    </div>
                                                <?php elseif($r['status'] == 'Rejected'): ?>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Tidak ada reservasi dengan nomor <?= htmlspecialchars($telepon) ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center mb-4">
                            <img src="assets/img/search.png" alt="Cek Reservasi" width="120" class="mb-3">
                            <h4>Cek Status Reservasi Anda</h4>
                            <p class="text-muted">Masukkan nomor telepon yang digunakan saat reservasi</p>
                        </div>
                        
                        <form method="GET" action="cek_reservasi.php" class="row g-3">
                            <div class="col-md-9">
                                <input type="tel" name="telepon" class="form-control form-control-lg" 
                                       placeholder="Contoh: 081234567890" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-search me-1"></i> Cari
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="reservasi.php" class="btn btn-outline-success">
                            <i class="fas fa-plus me-1"></i> Reservasi Baru
                        </a>
                        <a href="index.php" class="btn btn-success">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Instructions Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-money-bill-transfer me-2"></i>Instruksi Pembayaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h5><i class="fas fa-university me-2"></i>Transfer Bank</h5>
                    <div class="ps-4 mt-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="assets/img/bca.png" alt="BCA" width="40" class="me-3">
                            <div>
                                <strong>BCA</strong>
                                <div class="text-success">1234 5678 9012</div>
                                <small>a.n. Wisata Alam Nebuba</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="assets/img/bri.png" alt="BRI" width="40" class="me-3">
                            <div>
                                <strong>BRI</strong>
                                <div class="text-success">9876 5432 1098</div>
                                <small>a.n. Wisata Alam Nebuba</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5><i class="fas fa-mobile-screen me-2"></i>E-Wallet</h5>
                    <div class="row ps-4 mt-3">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <img src="assets/img/gopay.png" alt="Gopay" width="40" class="me-3">
                                <div>
                                    <strong>Gopay</strong>
                                    <div class="text-success">0812 3456 7890</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <img src="assets/img/dana.png" alt="DANA" width="40" class="me-3">
                                <div>
                                    <strong>Dana</strong>
                                    <div class="text-success">0812 3456 7890</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success">
                    <i class="fas fa-circle-info me-2"></i>
                    <strong>Konfirmasi Pembayaran:</strong> Kirim bukti transfer ke 
                    <a href="https://wa.me/085342747891" class="fw-bold">WhatsApp Admin</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="fas fa-check me-1"></i> Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>