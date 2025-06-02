<?php
include 'koneksi.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $no_wa = $_POST['no_wa'] ?? '';

    $stmt = $koneksi->prepare("SELECT id_admin FROM admin WHERE username = ? AND no_wa = ?");
    $stmt->bind_param("ss", $username, $no_wa);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        $token = rand(100000, 999999); // Token 6 digit
        $expired = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $update = $koneksi->prepare("UPDATE admin SET reset_token = ?, reset_token_expired = ? WHERE id_admin = ?");
        $update->bind_param("ssi", $token, $expired, $admin['id_admin']);
        $update->execute();

        // Kirim kode token ke WhatsApp admin via Fonnte API
        $pesan = "Kode verifikasi untuk reset password Anda: $token (berlaku 15 menit)";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
            'target' => $no_wa,
            'message' => $pesan
        ]));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: $fonnte_api_token" // Ambil dari config.php
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($curl);
        curl_close($curl);

        // Redirect ke halaman verifikasi token
        $waLink = "https://wa.me/" . $no_wa . "?text=" . urlencode($pesan);
        header("Location: verifikasi_token.php?username=" . urlencode($username) . "&wa=" . urlencode($no_wa) . "&sendwa=" . urlencode($waLink));
        exit;
    } else {
        $error = "Username atau nomor WA salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/form.css" />
  <title>Lupa Password</title>
</head>
<body>
  <div class="container">
    <div class="green-section">
      <div class="inner-box">
        <img src="assets/img/1.png" alt="Ilustrasi" />
        <h1>Lupa Password</h1>
      </div>
    </div>
    <div class="form-section">
      <h2>Reset Password</h2>
      <p>Masukkan Username dan No WhatsApp Anda</p>
      <?php if (!empty($error)) echo "<div style='color:red;'>$error</div>"; ?>
      <form method="POST" style="display: flex; flex-direction: column; gap: 0;">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" placeholder="Username" required />
        </div>
        <div class="form-group">
          <label for="no_wa">Nomor WhatsApp:</label>
          <input type="text" id="no_wa" name="no_wa" placeholder="628xxxxxxx" required />
        </div>
        <div style="display: flex; gap: 10px; margin-top: 8px;">
          <button type="submit" class="btn">Kirim</button>
          <a href="login.php" class="btn" style="background:#888; color:#fff; text-decoration:none; text-align:center;">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>