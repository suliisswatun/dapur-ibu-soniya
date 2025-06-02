<?php
session_start();
include_once("../koneksi.php");

// Pastikan admin sudah login
if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

// Query untuk menampilkan admin dengan jumlah login lebih dari 5 kali
$query = "
  SELECT admin.username, COUNT(logins.id_login) AS total_logins
  FROM admin
  JOIN logins ON admin.id_admin = logins.id_admin
  GROUP BY admin.id_admin
  HAVING COUNT(logins.id_login) > 5
  ORDER BY total_logins DESC;
";

$result_stats = $koneksi->query($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
  <div class="container">
    <h2>Selamat datang, Admin!</h2>

    <?php
    if ($result_stats->num_rows > 0) {
      echo "<h3>Statistik Login Admin:</h3>";
      while ($row = $result_stats->fetch_assoc()) {
        echo "Username: " . $row['username'] . " - Total Login: " . $row['total_logins'] . "<br>";
      }
    } else {
      echo "Tidak ada admin yang login lebih dari 5 kali.";
    }
    ?>

    <a href="../logout.php">Logout</a>
  </div>
</body>
</html>
