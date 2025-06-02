<?php include '../koneksi.php'; ?>
<h2 style="text-align: center; font-family: Arial, sans-serif; color: #4CAF50;">Tambah Pesanan</h2>
<div style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9;">
    <form action="tambahpesanan.php" method="post" style="display: flex; flex-direction: column; gap: 15px;">
        <label style="font-weight: bold;">Nama Pemesan:</label>
        <input type="text" name="nama_pemesan" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="font-weight: bold;">Menu:</label>
        <select name="id_menu" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            $menu = mysqli_query($koneksi, "SELECT * FROM menu");
            while ($row = mysqli_fetch_assoc($menu)) {
                echo "<option value='{$row['id_menu']}'>{$row['nama_menu']} - Rp{$row['harga']}</option>";
            }
            ?>
        </select>

        <label style="font-weight: bold;">Jumlah:</label>
        <input type="number" name="jumlah_pesanan" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <button type="submit" style="padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Simpan</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_menu = $_POST['id_menu'];
    $nama = $_POST['nama_pemesan'];
    $jumlah = $_POST['jumlah_pesanan'];

    $menu = mysqli_query($koneksi, "SELECT harga FROM menu WHERE id_menu = $id_menu");
    $data = mysqli_fetch_assoc($menu);
    $harga = $data['harga'];
    $total = $jumlah * $harga;

    $sql = "INSERT INTO pesanan (id_menu, nama_pemesan, jumlah_pesanan, total_harga, waktu_pesan, status) 
            VALUES ('$id_menu', '$nama', '$jumlah', '$total', NOW(), 'menunggu')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<p style='text-align: center; color: green;'>
                <i class='fa fa-check-circle'></i> Pesanan berhasil ditambahkan. 
                <a href='pesanan.php' style='color: #4CAF50;'>Lihat Antrian</a>
              </p>";
    } else {
        echo "<p style='text-align: center; color: red;'>
                <i class='fa fa-times-circle'></i> Gagal: " . mysqli_error($koneksi) . "
              </p>";
    }
}
?>