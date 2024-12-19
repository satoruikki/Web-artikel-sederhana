<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php'); 
    exit; 
}

$hasil = $koneksi->query("SELECT * FROM tb_info ORDER BY dibuat_pada DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
    body {
        background-image: url(../image/indexbg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
    }
    </style>
    <link rel="icon" href="../image/logo.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark text-light-emphasis">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="index.php">Halaman Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active text-white" aria-current="page" href="tambah_artikel.php">Tambahkan artikel</a>
        <a class="nav-link text-white" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="text-center mb-4 text-white">
        <h1>Artikel Terbaru</h1>
        <p>Baca berita dan artikel menarik setiap hari.</p>
    </div>
    
    <div class="row">
        <?php while ($row = $hasil->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= htmlspecialchars($row['gambar_url']) ?>" class="card-img-top" alt="Gambar Artikel">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['ringkasan']) ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="lihat.php?id=<?= $row['id'] ?>" class="btn btn-primary">Baca Selengkapnya</a><br><br>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus artikel ini?');">Hapus artikel</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
