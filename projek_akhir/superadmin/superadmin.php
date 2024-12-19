<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['superadmin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['hapus_id'])) {
    $id = intval($_GET['hapus_id']);

    $hapus = $koneksi->prepare("DELETE FROM admin WHERE id = ?");
    $hapus->bind_param("i", $id);

    if ($hapus->execute()) {
        echo "<script>alert('Admin berhasil dihapus!'); window.location.href = 'superadmin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus admin!');</script>";
    }
}

$admin_data = $koneksi->query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Superadmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa;">

<div class="container mt-5">
    <h2 class="text-center">Superadmin</h2>
    <div class="text-end mb-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $admin_data->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td>
                        <a href="superadmin.php?hapus_id=<?= $row['id'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus admin ini?');" 
                           class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
