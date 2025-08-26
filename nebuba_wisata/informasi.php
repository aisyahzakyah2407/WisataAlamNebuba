<?php 
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';

$query = "SELECT * FROM informasi ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<style>
    .card-img-container {
        height: 250px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .card:hover .card-img-top {
        transform: scale(1.03);
    }
    .modal-img {
        max-width: 100%;
        max-height: 60vh;
        display: block;
        margin: 0 auto;
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-5">Informasi Terbaru</h1>
    
    <div class="row">
        <?php while($informasi = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-img-container" 
                     data-bs-toggle="modal" 
                     data-bs-target="#infoModal<?= $informasi['id'] ?>">
                    <img src="assets/img/informasi/<?= htmlspecialchars($informasi['gambar']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($informasi['judul']) ?>"
                         loading="lazy">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($informasi['judul']) ?></h5>
                    <p class="text-muted"><small><?= date('d F Y', strtotime($informasi['tanggal'])) ?></small></p>
                    <p class="card-text"><?= substr(htmlspecialchars($informasi['isi']), 0, 200) ?>...</p>
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#infoModal<?= $informasi['id'] ?>">Baca Selengkapnya</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="infoModal<?= $informasi['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= htmlspecialchars($informasi['judul']) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <img src="assets/img/informasi/<?= htmlspecialchars($informasi['gambar']) ?>" 
                                 class="modal-img" 
                                 alt="<?= htmlspecialchars($informasi['judul']) ?>">
                        </div>
                        <p><?= nl2br(htmlspecialchars($informasi['isi'])) ?></p>
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