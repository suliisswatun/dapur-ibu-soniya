<?php
include '../koneksi.php';

$id = $_GET['id'];
$pesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pesanan = $id"));

if (!$pesanan) {
    header("Location: pesanan.php?msg=notfound");
    exit;
}

$prev = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM pesanan 
    WHERE waktu_pesan < '{$pesanan['waktu_pesan']}' 
    AND status != 'selesai' 
    ORDER BY waktu_pesan DESC LIMIT 1
"));

if ($pesanan['status'] == 'selesai') {
    header("Location: pesanan.php?msg=selesai");
} elseif ($prev) {
    echo "<script>
        alert('Pesanan ini masih dalam antrean. Hanya pesanan paling awal yang dapat dihapus terlebih dahulu (FIFO).');
        window.location.href = 'pesanan.php';
    </script>";
    exit;
} else {
    if (mysqli_query($koneksi, "DELETE FROM pesanan WHERE id_pesanan = $id")) {

        
        mysqli_query($koneksi, "
            UPDATE pesanan 
            SET status = 'diproses' 
            WHERE status != 'selesai' 
            ORDER BY waktu_pesan ASC 
            LIMIT 1
        ");

        header("Location: pesanan.php?msg=sukses");
    } else {
        header("Location: pesanan.php?msg=gagal");
    }
}
exit;
?>
