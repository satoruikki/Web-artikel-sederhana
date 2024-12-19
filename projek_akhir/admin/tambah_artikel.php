<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $ringkasan = $_POST['ringkasan'];
    $konten = $_POST['konten'];

    $upload_dir = '../image/';
    $allowed_types = ['image/png', 'image/jpeg', 'image/jpg'];
    $max_file_size = 5 * 1024 * 1024;

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_name = basename($_FILES['gambar']['name']);
        $file_type = mime_content_type($file_tmp);
        $file_size = $_FILES['gambar']['size'];

        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Hanya file PNG dan JPG yang diperbolehkan!');</script>";
            exit;
        }

        if ($file_size > 3145728) {
            echo "<script>alert('Ukuran file tidak boleh lebih dari 3MB!');</script>";
            exit;
        }

        $target_file = $upload_dir . time() . "_" . $file_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            $gambar_url = $target_file;
        } else {
            echo "<script>alert('Gagal mengunggah file!');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Harap unggah gambar!');</script>";
        exit;
    }

    $sql = $koneksi->prepare("INSERT INTO tb_info (judul, ringkasan, konten, gambar_url) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $judul, $ringkasan, $konten, $gambar_url);
    $sql->execute();

    echo "<script>alert('Artikel berhasil ditambahkan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin</title>
    <style>
        body {
            background-image: url(../image/admin_bg.jpg);
            background-size: cover;
        }
    </style>
    <link rel="icon" href="../image/logo.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Bootstrap -->
            <div class="card bg-transparent shadow">
                <div class="card-header  text-light text-center">
                    <h3>Tambah Artikel Baru</h3>
                </div>
                <div class="card-body">

                    <form method="POST" action="tambah_artikel.php" enctype="multipart/form-data" class="mt-3">
                        <div class="mb-3">
                            <input type="text" name="judul" placeholder="Judul artikel" class="form-control" required>
                        </div>
                    <div class="mb-3">
                            <textarea name="ringkasan" placeholder="Ringkasan artikel" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="konten" placeholder="Isi artikel" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="gambar" class="form-control" accept=".png, .jpg, .jpeg" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Tambah Artikel</button>
                            <br><br>
                            <a href="index.php" class="btn btn-info">Ke Halaman Utama</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
