<?php
include('../koneksi.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id_menu'])) {
    $id_menu = $_GET['id_menu'];

    // Ambil data menu dari database
    $query = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
    $result = mysqli_query($koneksi, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<script>alert('ID menu tidak ditemukan di database.'); window.location='tabelmenu.php';</script>";
        exit;
    }

    $data = mysqli_fetch_assoc($result);
    $foto_menu = $data['foto_menu'];

    // Hapus file gambar jika ada
    $foto_path = "../foto_menu/" . $foto_menu;
    if (file_exists($foto_path)) {
        unlink($foto_path); // Hapus file dari folder
    }

    $delete_query = "DELETE FROM menu WHERE id_menu = '$id_menu'";
    $delete = mysqli_query($koneksi, $delete_query);

    if ($delete) {
        echo "<script>alert('Data berhasil dihapus.'); window.location='tabelmenu.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location='tabelmenu.php';</script>";
    }

} else {
    echo "<script>alert('ID menu tidak ditemukan.'); window.location='tabelmenu.php';</script>";
}
?>
