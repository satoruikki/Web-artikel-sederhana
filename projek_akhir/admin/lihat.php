<?php
session_start();
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $stmt = $koneksi->prepare("SELECT * FROM tb_info WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Artikel tidak ditemukan!'); window.location='index.php';</script>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['judul']); ?></title>
    <style>
        body{
            background-color: color-mix(in srgb, color percentage, color percentage);
        }
    </style>
    <link rel="icon" href="../image/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white" >
<div class="container mt-5">
    <h1 class="text-center mb-4"><?php echo htmlspecialchars($row['judul']); ?></h1>
    <div class="text-center mb-4">
        <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" alt="Gambar Artikel" class="img-fluid rounded" style="max-height: 400px;">
    </div>
    <div class="mb-3">
        <p><?php echo nl2br(htmlspecialchars($row['ringkasan'])); ?></p>
    </div>
    <div>
        <p><?php echo nl2br(htmlspecialchars($row['konten'])); ?></p>
    </div>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>
</div>
</body>
</html>
