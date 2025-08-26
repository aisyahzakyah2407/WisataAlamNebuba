<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
include '../config/database.php';

if(!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-success">Dashboard Administrator</h1>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Profil Wisata</h5>
                        <a href="kelola_profil.php" class="btn btn-success mt-3">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Fasilitas</h5>
                        <a href="kelola_fasilitas.php" class="btn btn-success mt-3">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Galeri</h5>
                        <a href="kelola_galeri.php" class="btn btn-success mt-3">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Informasi</h5>
                        <a href="kelola_informasi.php" class="btn btn-success mt-3">Kelola</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kontak</h5>
                        <a href="kelola_kontak.php" class="btn btn-success mt-3">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Reservasi</h5>
                        <a href="kelola_reservasi.php" class="btn btn-success mt-3">Kelola</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>