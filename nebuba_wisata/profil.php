<?php 
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

$query = "SELECT * FROM profil LIMIT 1";
$result = mysqli_query($conn, $query);
$profil = mysqli_fetch_assoc($result);
?>

<style>
    /* Gaya untuk gambar profil yang bisa diklik */
    .profile-img-container {
        height: 400px;
        overflow: hidden;
        border-radius: 8px;
        cursor: pointer;
        position: relative;
    }
    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .profile-img-container:hover .profile-img {
        transform: scale(1.03);
    }
    
    /* Gaya untuk card yang lebih compact */
    .compact-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .compact-card .card-body {
        flex-grow: 1;
    }
    
    /* Gaya untuk peta */
    .map-container {
        height: 200px;
        border-radius: 8px;
        overflow: hidden;
        margin: 10px 0;
        border: 1px solid #dee2e6;
    }
    
    /* Modal untuk gambar besar */
    .modal-img {
        max-width: 100%;
        max-height: 80vh;
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-5">Profil Wisata Alam Nebuba</h1>
    
    <div class="row mb-5">
        <div class="col-md-6">
            <!-- Gambar profil yang bisa diklik -->
            <div class="profile-img-container shadow" 
                 data-bs-toggle="modal" 
                 data-bs-target="#imageModal">
                <img src="assets/img/pii.jpeg" 
                     class="profile-img" 
                     alt="Profil Wisata Nebuba">
            </div>
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($profil['judul']) ?></h2>
            <p><?= nl2br(htmlspecialchars($profil['isi'])) ?></p>
        </div>
    </div>
<div class="row g-4">
    <!-- Card Lokasi dengan Peta (Tinggi alami sesuai konten) -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Lokasi</h5>
                
                <div class="map-container mt-2" style="height: 200px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.865237818342!2d120.20610487406!3d-3.1303005404202078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d9157e168042395%3A0x47b4bed095d6499e!2sNegeri%20Seribu%20Batu%20(NeBuBa)%20%22Pondok%20Mahari%22!5e0!3m2!1sid!2sid!4v1754227941896!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" 
                            width="100%" 
                            height="100%" 
                            style="border:0;"></iframe>
                </div>
                
                <a href="https://maps.google.com/?q=..." 
                   class="btn btn-success btn-sm mt-3 w-100">
                   <i class="bi bi-arrow-up-right-circle"></i> Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
    
    <!-- Card Luas Area (Tinggi minimal) -->
    <div class="col-md-4">
        <div class="card shadow-sm h-auto"> <!-- h-auto untuk tinggi alami -->
            <div class="card-body">
                <h5 class="card-title">Luas Area</h5>
                <p class="card-text mb-0"> <!-- mb-0 untuk menghilangkan margin bawah -->
                    3,2 Hektar dengan panorama alam sungai jernih yang diapit dua bukit
                </p>
            </div>
        </div>
    </div>
    
    <!-- Card Daya Tarik (Tinggi minimal) -->
    <div class="col-md-4">
        <div class="card shadow-sm h-auto"> <!-- h-auto untuk tinggi alami -->
            <div class="card-body">
                <h5 class="card-title">Daya Tarik</h5>
                <p class="card-text mb-0"> <!-- mb-0 untuk menghilangkan margin bawah -->
                    Batu-batu sungai yang tersusun alami, spot foto menarik, dan suasana alam yang menenangkan
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk gambar profil -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="assets/img/pii.jpeg" class="modal-img" alt="Profil Wisata Nebuba">
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>