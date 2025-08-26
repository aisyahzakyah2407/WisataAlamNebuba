<?php 
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
    
    $query = "INSERT INTO kontak (nama, telepon, pesan) VALUES ('$nama', '$telepon', '$pesan')";
    mysqli_query($conn, $query);
    
    echo '<div class="alert alert-success">Pesan Anda telah terkirim. Terima kasih!</div>';
}

$query = "SELECT * FROM kontak WHERE nama IS NULL LIMIT 1";
$result = mysqli_query($conn, $query);
$kontak = mysqli_fetch_assoc($result);
?>

<div class="container my-5">
    <h1 class="text-center mb-5">Hubungi Kami</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Informasi Kontak</h5>
                    <p class="card-text"><i class="bi bi-geo-alt-fill"></i> <?= $kontak['alamat'] ?></p>
                    <p class="card-text"><i class="bi bi-telephone-fill"></i> <?= $kontak['telepon'] ?></p>
                    <p class="card-text"><i class="bi bi-clock-fill"></i> <?= $kontak['jam_operasional'] ?></p>
                    
                    <div class="mt-3">
                        <h6>Hubungi Kami Via:</h6>
                        <a href="https://wa.me/62<?= $kontak['whatsapp'] ?>" class="btn btn-success btn-sm me-2 mb-2">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://instagram.com/<?= $kontak['instagram'] ?>" class="btn btn-danger btn-sm me-2 mb-2">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="https://facebook.com/<?= $kontak['facebook'] ?>" class="btn btn-primary btn-sm mb-2">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lokasi Kami</h5>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.865237818342!2d120.20610487406!3d-3.1303005404202078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d9157e168042395%3A0x47b4bed095d6499e!2sNegeri%20Seribu%20Batu%20(NeBuBa)%20%22Pondok%20Mahari%22!5e0!3m2!1sid!2sid!4v1754227941896!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kirim Pesan Langsung</h5>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input type="tel" class="form-control" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan Anda</label>
                            <textarea class="form-control" name="pesan" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-send-fill"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>