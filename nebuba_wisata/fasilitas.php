<?php 
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

$query = "SELECT * FROM fasilitas";
$result = mysqli_query($conn, $query);
?>

<style>
    .card-img-container {
        height: 300px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        cursor: pointer;
        position: relative;
    }
    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    .modal-img {
        max-width: 100%;
        max-height: 80vh;
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-5">Fasilitas Wisata Alam Nebuba</h1>
    
    <div class="row">
        <?php while($fasilitas = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-img-container" 
                     data-bs-toggle="modal" 
                     data-bs-target="#fasilitasModal<?= $fasilitas['id'] ?>">
                    <img src="assets/img/fasilitas/<?= htmlspecialchars($fasilitas['gambar']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($fasilitas['nama']) ?>"
                         loading="lazy">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($fasilitas['nama']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($fasilitas['keterangan'])) ?></p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fasilitasModal<?= $fasilitas['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= htmlspecialchars($fasilitas['nama']) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <img src="assets/img/fasilitas/<?= htmlspecialchars($fasilitas['gambar']) ?>" 
                                 class="modal-img" 
                                 alt="<?= htmlspecialchars($fasilitas['nama']) ?>">
                        </div>
                        <p><?= nl2br(htmlspecialchars($fasilitas['keterangan'])) ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>