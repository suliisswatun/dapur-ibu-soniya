<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
  echo "<script>alert('Anda harus login terlebih dahulu!'); location.href='../login.php';</script>";
  exit();
}
?>