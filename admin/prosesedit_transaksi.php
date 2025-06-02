<?php
include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && 
    isset($_POST["id_keuangan"]) && 
    !empty($_POST["tanggal_transaksi"]) && 
    !empty($_POST["jenis"]) && 
    !empty($_POST["catatan"]) && 
    !empty($_POST["jumlah"])) {

    // Ambil data dari formulir
    $id_keuangan = $_POST["id_keuangan"];
    $tanggal_transaksi = date("Y-m-d H:i:s", strtotime($_POST["tanggal_transaksi"]));
    $jenis = $_POST["jenis"];
    $catatan = $_POST["catatan"];
    $jumlah = $_POST["jumlah"];

    // Update data di database
    $query = "UPDATE data_keuangan SET tanggal_transaksi='$tanggal_transaksi', jenis='$jenis', 
              catatan='$catatan', jumlah='$jumlah' WHERE id_keuangan='$id_keuangan'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Transaksi berhasil diperbarui!'); window.location='datakeuangan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui transaksi: " . mysqli_error($koneksi) . "');</script>";
    }
} else {
    echo "<script>alert('Data tidak valid atau belum diisi!'); window.location='datakeuangan.php';</script>";
}
?>
