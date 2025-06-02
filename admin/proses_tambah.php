<?php
include_once("../session.php");
include('../koneksi.php');
$id_admin = isset($_SESSION['id_admin']) ? intval($_SESSION['id_admin']) : 0;

if ($id_admin == 0) {
    die("ID admin tidak ditemukan di session. Pastikan sudah login.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nama_menu   = mysqli_real_escape_string($koneksi, $_POST['nama_menu']);
    $jenis_menu  = mysqli_real_escape_string($koneksi, $_POST['jenis_menu']); 
    $harga       = mysqli_real_escape_string($koneksi, $_POST['harga']);

    $foto = $_FILES['foto_menu']['name'];
    $tmp = $_FILES['foto_menu']['tmp_name'];
    $folder = "../foto_menu/";

    // Buat nama file unik agar tidak bentrok
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $foto_baru = uniqid('menu_', true) . '.' . $ext;

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    if (move_uploaded_file($tmp, $folder . $foto_baru)) {
        $query_insert = "INSERT INTO menu (nama_menu, jenis_menu, harga, foto_menu, id_admin)
                         VALUES ('$nama_menu', '$jenis_menu', '$harga', '$foto_baru', '$id_admin')";
        $insert = mysqli_query($koneksi, $query_insert);

        if ($insert) {
            header("Location: tabelmenu.php");
            exit;
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengupload foto.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
    <style>
        * {
            font-family: "Trebuchet MS";
        }
        h1{
            text-transform: uppercase;
            color: black;
            text-align: center;
        }
        .base{
            width: 400px;
            padding: 20px;
            margin: 20px auto;
            background-color: #2ecc71;
            border-radius: 8px;
        }
        label{
            margin-top: 10px;
            display: block;
            text-align: left;
            color: white;
        }
        input, select {
            padding: 6px;
            width: 100%;
            box-sizing: border-box;
            background-color: #f8f8f8;
            border: 2px solid #ccc;
            border-radius: 4px;
            outline-color: salmon;
        }
    </style>
</head>
<body>

<div class="base">
    <h1>Tambah Menu</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Menu:</label>
        <input type="text" name="nama_menu" required>

        <label>Jenis Menu:</label>
        <input type="text" name="jenis_menu" required>

        <label>Harga:</label>
        <input type="number" name="harga" required>

        <label>Foto Menu:</label>
        <input type="file" name="foto_menu" accept="image/*" required>

        <input type="submit" value="Simpan">
    </form>
</div>

</body>
</html>