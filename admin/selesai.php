<?php
include '../koneksi.php';
$first_in_process = mysqli_query($koneksi, "SELECT id_pesanan FROM pesanan WHERE status = 'diproses' ORDER BY waktu_pesan ASC LIMIT 1");
$first_process = mysqli_fetch_assoc($first_in_process);
if ($first_process) {
    $id_pesanan = $first_process['id_pesanan'];
    mysqli_query($koneksi, "UPDATE pesanan SET status = 'selesai' WHERE id_pesanan = $id_pesanan");
}

?>

<h2>Pesanan Selesai</h2>
<table border="1" cellpadding="5">
    <tr><th>Nama</th><th>Menu</th><th>Jumlah</th><th>Total</th><th>Waktu</th></tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['nama_pemesan']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['jumlah_pesanan']}</td>
            <td>Rp{$row['total_harga']}</td>
            <td>{$row['waktu_pesan']}</td>
        </tr>";
    } ?>
</table>
