<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.php">Wisata Nebuba</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fasilitas.php">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="galeri.php">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="informasi.php">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kontak.php">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservasi.php">Reservasi</a>
                </li>
            </ul>
            
            <!-- Add reservation check form -->
            <form class="d-flex ms-2" method="GET" action="cek_reservasi.php">
    <div class="input-group" style="min-width: 200px;">
        <input type="tel" class="form-control form-control-sm" 
               name="telepon" placeholder="Cek Status Reservasi" 
               required>
        <button class="btn btn-light btn-sm" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
            
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['username'])): ?>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login Admin</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>