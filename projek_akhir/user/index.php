<?php
include '../config/database.php';

$hasil = $koneksi->query("SELECT * FROM tb_info ORDER BY dibuat_pada DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Artikel Terbaru</title>
    <link rel="icon" href="../image/logo.jpg">
    <style>
        body {
            background-image: url(../image/indexbg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            color: white;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

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
                        <a href="../admin/lihat.php?id=<?= $row['id'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
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
