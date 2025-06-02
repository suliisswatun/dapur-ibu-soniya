<?php
include '../koneksi.php';

$id = $_GET['id'];
$pesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pesanan = $id"));


$prevPesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM pesanan 
    WHERE waktu_pesan < '{$pesanan['waktu_pesan']}' 
    AND status != 'selesai' 
    ORDER BY waktu_pesan ASC LIMIT 1
"));

$bisa_edit = $pesanan['status'] != 'selesai';
$bisa_diproses = !$prevPesanan;
?>

<h2 style="text-align: center; font-family: Arial, sans-serif; color: #4CAF50;">Edit Pesanan</h2>
<div style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9;">
<form method="post" style="display: flex; flex-direction: column; gap: 15px;">
    <label style="font-weight: bold;">Nama Pemesan:</label>
    <input type="text" name="nama_pemesan" value="<?= htmlspecialchars($pesanan['nama_pemesan']) ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

    <label style="font-weight: bold;">Menu:</label>
    <select name="id_menu" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <?php
        $menu = mysqli_query($koneksi, "SELECT * FROM menu");
        while ($row = mysqli_fetch_assoc($menu)) {
            $selected = $row['id_menu'] == $pesanan['id_menu'] ? 'selected' : '';
            echo "<option value='{$row['id_menu']}' $selected>{$row['nama_menu']}</option>";
        }
        ?>
    </select>

    <label style="font-weight: bold;">Jumlah:</label>
    <input type="number" name="jumlah_pesanan" value="<?= htmlspecialchars($pesanan['jumlah_pesanan']) ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

    <label style="font-weight: bold;">Status:</label>
    <?php if (!$bisa_edit): ?>
        <p style='color:red;'>Pesanan ini sudah selesai dan tidak bisa diubah lagi.</p>
    <?php elseif (!$bisa_diproses && $pesanan['status'] != 'diproses'): ?>
        <p style="color:orange;">Pesanan belum bisa diproses atau diselesaikan karena masih ada pesanan sebelumnya yang belum selesai.</p>
    <?php endif; ?>

    <select name="status" <?= !$bisa_edit ? 'disabled' : '' ?> style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <?php
        $statuses = ['menunggu', 'diproses', 'selesai'];
        foreach ($statuses as $status_option) {
            
            if (in_array($status_option, ['diproses', 'selesai']) && !$bisa_diproses && $pesanan['status'] != $status_option) {
                continue;
            }
            $selected = $pesanan['status'] == $status_option ? 'selected' : '';
            echo "<option value='$status_option' $selected>$status_option</option>";
        }
        ?>
    </select>

    <button type="submit" <?= !$bisa_edit ? 'disabled' : '' ?> style="padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Simpan Perubahan</button>
</form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $bisa_edit) {
    $id_menu = $_POST['id_menu'];
    $nama = $_POST['nama_pemesan'];
    $jumlah = $_POST['jumlah_pesanan'];
    $status = $_POST['status'];

    
    if (($status == 'diproses' || $status == 'selesai') && !$bisa_diproses && $pesanan['status'] != $status) {
        die("Status tidak dapat diubah karena masih ada pesanan sebelumnya yang belum selesai.");
    }

    $menu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM menu WHERE id_menu = $id_menu"));
    $total = $menu['harga'] * $jumlah;

    $update = "UPDATE pesanan SET 
               id_menu = '$id_menu',
               nama_pemesan = '$nama',
               jumlah_pesanan = '$jumlah',
               total_harga = '$total',
               status = '$status'
               WHERE id_pesanan = $id";

    if (mysqli_query($koneksi, $update)) {
    
        if ($status == 'selesai') {
            $next = mysqli_fetch_assoc(mysqli_query($koneksi, "
                SELECT * FROM pesanan 
                WHERE waktu_pesan > '{$pesanan['waktu_pesan']}' 
                AND status = 'menunggu' 
                ORDER BY waktu_pesan ASC LIMIT 1
            "));

            if ($next) {
                mysqli_query($koneksi, "
                    UPDATE pesanan SET status = 'diproses' 
                    WHERE id_pesanan = {$next['id_pesanan']}
                ");
            }
        }

        header("Location: pesanan.php?alert=update");
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>
