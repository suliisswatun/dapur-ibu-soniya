<?php
include('../koneksi.php');



if (!isset($_GET['id_menu'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location='tabelmenu.php';</script>";
    exit;
}

$id_menu = $_GET['id_menu'];
$query = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan'); window.location='tabelmenu.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Menu</title>
</head>
<body>
    <h2>Hapus Menu</h2>
    <p>Apakah kamu yakin ingin menghapus menu <strong><?php echo htmlspecialchars($data['nama_menu']); ?></strong>?</p>
    <form action="proses_hapus.php" method="GET">
        <input type="hidden" name="id_menu" value="<?php echo $data['id_menu']; ?>">
        <button type="submit" onclick="return confirm('Yakin hapus data?')">Ya, Hapus</button>
        <a href="tabelmenu.php">Batal</a>
    </form>
</body>
</html>
