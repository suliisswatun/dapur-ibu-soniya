<?php
include("../koneksi.php");

if (isset($_GET["id_keuangan"])) {
    $id_keuangan = $_GET["id_keuangan"];
    $query = "SELECT * FROM data_keuangan WHERE id_keuangan = '$id_keuangan'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Transaksi tidak ditemukan!'); window.location='datakeuangan.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID Transaksi tidak diberikan!'); window.location='datakeuangan.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Transaksi</title>
</head>
<body>
    <h2>Konfirmasi Hapus Transaksi</h2>
    <p>Apakah Anda yakin ingin menghapus transaksi berikut?</p>

    <p><strong>Tanggal:</strong> <?php echo date("d-m-Y H:i:s", strtotime($data['tanggal_transaksi'])); ?></p>
    <p><strong>Jenis:</strong> <?php echo $data['jenis']; ?></p>
    <p><strong>Catatan:</strong> <?php echo $data['catatan']; ?></p>
    <p><strong>Jumlah:</strong> Rp <?php echo number_format((float)$data['jumlah'], 0, ',', '.'); ?></p>

    <form method="POST" action="proseshapus_transaksi.php">
        <input type="hidden" name="id_keuangan" value="<?php echo $data['id_keuangan']; ?>">
        <button type="submit">Hapus</button>
        <a href="datakeuangan.php">Batal</a>
    </form>
</body>
</html>
