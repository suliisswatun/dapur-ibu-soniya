<?php
include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_keuangan"])) {
    $id_keuangan = $_POST["id_keuangan"];

    
    $query = "DELETE FROM data_keuangan WHERE id_keuangan = '$id_keuangan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Transaksi berhasil dihapus!'); window.location='datakeuangan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus transaksi: " . mysqli_error($koneksi) . "');</script>";
    }
} else {
    echo "<script>alert('Data tidak valid!'); window.location='datakeuangan.php';</script>";
}
?>
