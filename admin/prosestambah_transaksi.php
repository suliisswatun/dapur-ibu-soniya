<?php
include("../koneksi.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tanggal_transaksi"]) && isset($_POST["jenis"]) && isset($_POST["catatan"]) && isset($_POST["jumlah"])) {
        $tanggal_transaksi = date("Y-m-d H:i:s", strtotime($_POST["tanggal_transaksi"]));
        $jenis = $_POST["jenis"];
        $catatan = $_POST["catatan"];
        $jumlah = $_POST["jumlah"];

        $query = "INSERT INTO data_keuangan (tanggal_transaksi, jenis, catatan, jumlah) 
                  VALUES ('$tanggal_transaksi', '$jenis', '$catatan', '$jumlah')";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='datakeuangan.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan transaksi: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('Data tidak valid atau belum diisi!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
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

