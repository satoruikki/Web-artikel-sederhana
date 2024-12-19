<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $query_gambar = $koneksi->prepare("SELECT gambar_url FROM tb_info WHERE id = ?");
    $query_gambar->bind_param("i", $id);
    $query_gambar->execute();
    $result = $query_gambar->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $gambar_url = $data['gambar_url'];

        $query_hapus = $koneksi->prepare("DELETE FROM tb_info WHERE id = ?");
        $query_hapus->bind_param("i", $id);

        if ($query_hapus->execute()) {
            if (file_exists($gambar_url)) {
                unlink($gambar_url);
            }
            echo "<script>alert('Artikel berhasil dihapus!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus artikel.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Artikel tidak ditemukan.'); window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('ID artikel tidak valid.'); window.location.href = 'index.php';</script>";
}
?>
