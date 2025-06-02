<?php
include 'koneksi.php';

$username = $_GET['username'] ?? $_POST['username'] ?? '';
$wa = $_GET['wa'] ?? '';
$sendwa = $_GET['sendwa'] ?? '';
$error = '';

// Tambahkan notifikasi jika $sendwa kosong
if (empty($sendwa) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = "Token belum dikirim ke WhatsApp Anda. Silakan ulangi proses lupa password.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $stmt = $koneksi->prepare("SELECT reset_token, reset_token_expired FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if ($token == $admin['reset_token'] && strtotime($admin['reset_token_expired']) > time()) {
            header("Location: ubah_password.php?username=" . urlencode($username));
            exit;
        } else {
            $error = "Token salah atau sudah kadaluarsa.";
        }
    } else {
        $error = "User tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/form.css" />
  <title>Verifikasi Token</title>
</head>
<body>
  <div class="container">
    <div class="green-section">
      <div class="inner-box">
        <img src="assets/img/1.png" alt="Ilustrasi" />
        <h1>Verifikasi Token</h1>
      </div>
    </div>
    <div class="form-section">
      <h2>Masukkan Kode Token</h2>
      <p>Masukkan kode 6 digit yang dikirim ke WhatsApp Anda.</p>
      <?php if (!empty($sendwa)): ?>
        <a href="<?= htmlspecialchars($sendwa) ?>" target="_blank" class="btn" style="margin-bottom:10px;">Klik untuk buka WhatsApp</a>
      <?php endif; ?>
      <?php if (!empty($error)) echo "<div style='color:red;'>$error</div>"; ?>
      <form method="POST">
        <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
        <div class="form-group">
          <label for="token">Kode Token:</label>
          <input type="text" id="token" name="token" placeholder="6 digit" required />
        </div>
        <button type="submit" class="btn">Verifikasi</button>
      </form>
    </div>
  </div>
</body>
</html>
