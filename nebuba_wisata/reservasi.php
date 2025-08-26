<?php 
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $jenis = $_POST['jenis'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    
    $query = "INSERT INTO reservasi (nama, telepon, jenis, tanggal, jumlah) 
              VALUES ('$nama', '$telepon', '$jenis', '$tanggal', '$jumlah')";
    mysqli_query($conn, $query);
    
    $show_success = true; // Set flag for success message
}
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Reservasi Wisata Alam Nebuba</h1>
    
    <?php if(isset($show_success)): ?>
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0"><i class="fas fa-check-circle me-2"></i> Reservasi Berhasil</h4>
                </div>
                <div class="card-body text-center py-4">
                    <p class="lead mb-4">
                        Reservasi Anda telah berhasil dikirimkan.<br>
                        Tim kami akan segera menghubungi Anda untuk konfirmasi.
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="index.php" class="btn btn-outline-success me-3">
                            <i class="fas fa-home me-1"></i> Kembali ke Beranda
                        </a>
                        <a href="reservasi.php" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Buat Reservasi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="form-container">
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon/WA</label>
                <input type="tel" class="form-control" id="telepon" name="telepon" required>
                <small class="text-muted">Nomor ini akan menjadi ID untuk cek status reservasi</small>
            </div>
            <div class="mb-3">
    <label for="jenis" class="form-label">Jenis Reservasi</label>
    <select class="form-select" id="jenis" name="jenis" required>
        <option value="" selected disabled>Pilih Jenis Reservasi</option>
        <option value="Tiket Masuk">Tiket Masuk</option>
        <optgroup label="Vila">
            <option value="Vila A (Rp 300.000/malam)">Vila Kurcaci 1 Lt - Rp 300.000/malam</option>
            <option value="Vila B (Rp 500.000/malam)">Vila Kurcaci 2 Lt - Rp 500.000/malam</option>
            <option value="Vila C (Rp 800.000/malam)">Vila Pondok Mahari - Rp 800.000/malam</option>
            <option value="Vila VIP (Rp 1.500.000/malam)">Vila Bukit - Rp 1.500.000/malam</option>
        </optgroup>
        <option value="Tenda">Tenda</option>
        <option value="Lapak">Lapak</option>
    </select>
</div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                <small class="text-muted">Untuk tiket: jumlah orang, untuk vila/tenda/lapak: jumlah unit</small>
            </div>
                        <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Penting:</strong> Simpan nomor telepon Anda untuk mengecek status reservasi nanti.
            </div>
            <button type="submit" class="btn btn-success w-100">Kirim Reservasi</button>
        </form>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Tiket Masuk</h5>
                    <p class="card-text">Rp 15.000/orang</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Vila</h5>
                    <p class="card-text">Rp 300.000-1.500.000/malam</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Tenda</h5>
                    <p class="card-text">Rp 200.000-300.000/malam</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>