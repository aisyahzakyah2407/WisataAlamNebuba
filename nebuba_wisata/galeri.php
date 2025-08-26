<?php 
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

$query = "SELECT * FROM galeri";
$result = mysqli_query($conn, $query);
?>

<style>
    .gallery-img-container {
        height: 250px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        border-radius: 8px;
    }
    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .gallery-img-container:hover .gallery-img {
        transform: scale(1.05);
    }
    .modal-img {
        max-width: 100%;
        max-height: 80vh;
    }
    .image-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 10px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    .gallery-img-container:hover .image-caption {
        transform: translateY(0);
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-5">Galeri Wisata Alam Nebuba</h1>
    
    <div class="row g-4">
        <?php while($galeri = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 col-sm-6">
            <div class="gallery-img-container shadow-sm" 
                 data-bs-toggle="modal" 
                 data-bs-target="#imageModal<?= $galeri['id'] ?>">
                <img src="assets/img/galeri/<?= htmlspecialchars($galeri['gambar']) ?>" 
                     class="gallery-img" 
                     alt="<?= htmlspecialchars($galeri['keterangan']) ?>">
                <div class="image-caption">
                    <p class="mb-0"><?= htmlspecialchars($galeri['keterangan']) ?></p>
                </div>
            </div>
        </div>

        <!-- Modal for each image -->
        <div class="modal fade" id="imageModal<?= $galeri['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="assets/img/galeri/<?= htmlspecialchars($galeri['gambar']) ?>" 
                             class="modal-img" 
                             alt="<?= htmlspecialchars($galeri['keterangan']) ?>">
                        <div class="mt-3">
                            <p><?= htmlspecialchars($galeri['keterangan']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>