<?php 
include 'includes/header.php';
include 'includes/navbar.php';
?>

<style>
    /* CSS untuk mengatur ukuran gambar di card */
    .card-img-top {
        width: 100%;
        height: 300px; /* Sesuaikan tinggi yang diinginkan */
        object-fit: cover; /* Gambar akan menutupi area tanpa terdistorsi */
        object-position: center; /* Fokus ke tengah gambar */
    }
    /* Pastikan card memiliki tinggi yang konsisten */
    .card {
        height: 100%;
    }
</style>

<div class="hero-section position-relative overflow-hidden">
    <!-- Konten Teks (tetap seperti yang Anda inginkan) -->
    <div class="container position-relative z-index-2 text-center text-white">
        <h1 class="display-4 fw-bold">Selamat Datang di Wisata Alam Nebuba</h1>
        <p class="lead">Negeri Seribu Batu yang Memukau di Kabupaten Luwu</p>
        <a href="profil.php" class="btn btn-success btn-lg mt-3">Jelajahi Sekarang</a>
    </div>
    
    <!-- Slider Background -->
    <div class="hero-slider position-absolute top-0 start-0 w-100 h-100">
        <div class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target=".carousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target=".carousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target=".carousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="assets/img/slide1.jpeg" class="d-block w-100 h-100" alt="Pemandangan Nebuba">
                </div>
                <div class="carousel-item h-100">
                    <img src="assets/img/pii.jpeg" class="d-block w-100 h-100" alt="Ayunan Nebuba">
                </div>
                <div class="carousel-item h-100">
                    <img src="assets/img/profil.jpeg" class="d-block w-100 h-100" alt="Fasilitas Nebuba">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target=".carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target=".carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100">
                <img src="assets/img/slide1.jpeg" class="card-img-top" alt="Profil Wisata">
                <div class="card-body">
                    <h5 class="card-title">Profil Wisata</h5>
                    <p class="card-text">Temukan keindahan dan sejarah Wisata Alam Nebuba yang memesona.</p>
                    <a href="profil.php" class="btn btn-success">Lihat Profil</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100">
                <img src="assets/img/fasilitas/fasilitas.jpeg" class="card-img-top" alt="Fasilitas">
                <div class="card-body">
                    <h5 class="card-title">Fasilitas</h5>
                    <p class="card-text">Lihat berbagai fasilitas yang tersedia untuk kenyamanan pengunjung.</p>
                    <a href="fasilitas.php" class="btn btn-success">Lihat Fasilitas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100">
                <img src="assets/img/1.jpeg" class="card-img-top" alt="Reservasi">
                <div class="card-body">
                    <h5 class="card-title">Reservasi</h5>
                    <p class="card-text">Pesan tiket masuk, vila, tenda, atau lapak untuk kunjungan Anda.</p>
                    <a href="reservasi.php" class="btn btn-success">Reservasi Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>