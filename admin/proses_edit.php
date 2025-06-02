<?php
include('../koneksi.php');

$id_menu = isset($_POST['id_menu']) ? intval($_POST['id_menu']) : null;
$nama_menu = isset($_POST['nama_menu']) ? $_POST['nama_menu'] : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : '';

if (!$id_menu) {
    die("ID tidak ditemukan! Pastikan form mengirim input ID.");
}

if (isset($_FILES['foto_menu']) && $_FILES['foto_menu']['name'] != "") {
    $foto_menu = $_FILES['foto_menu']['name'];
    $file_tmp = $_FILES['foto_menu']['tmp_name'];

    $ekstensi_diperbolehkan = array('png','jpg','jpeg','img');
    $x = explode('.', $foto_menu);
    $ekstensi = strtolower(end($x));

    if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
        echo "<script>alert('Ekstensi gambar hanya bisa png, jpg, jpeg, dan img!');window.location='edit_menu.php?id=$id';</script>";
        exit;
    }

    $upload_dir = '../foto_menu/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $angka_acak = rand(1, 999);
    $nama_foto_baru = $angka_acak . '-' . $foto_menu;


    if (move_uploaded_file($file_tmp, $upload_dir . $nama_foto_baru)) {
        // Update data dengan foto baru
        $query = "UPDATE menu SET nama_menu='$nama_menu', harga='$harga', foto_menu='$nama_foto_baru' WHERE id_menu='$id_menu'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil diubah!');window.location='tabelmenu.php';</script>";
        }

    } else {
        echo "<script>alert('Gagal mengupload gambar!');window.location='edit_menu.php?id_menu=$id_menu';</script>";
    }

} else {

    $query = "UPDATE menu SET nama_menu='$nama_menu', harga='$harga' WHERE id_menu='$id_menu'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil diubah tanpa mengubah foto!');window.location='tabelmenu.php';</script>";
    }
}
?>
