<?php
include '../koneksi.php';

$id_admin = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if ($password !== '') {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE admin SET nama='$nama', username='$username', email='$email', password='$password_hash' WHERE id_admin='$id_admin'";
} else {
    $sql = "UPDATE admin SET nama='$nama', username='$username', email='$email' WHERE id_admin='$id_admin'";
}

if (mysqli_query($koneksi, $sql)) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    echo "<script>alert('Profil berhasil diupdate!'); window.location.href='profile.php';</script>";
} else {
    echo "<script>alert('Gagal update profil: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
}
?>