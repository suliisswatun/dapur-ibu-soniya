<?php
$koneksi = mysqli_connect("localhost", "root", "", "dapuribusoniya");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
} else {
    // Debugging: Tambahkan pesan jika koneksi berhasil
    // echo "Koneksi berhasil";
}
?>