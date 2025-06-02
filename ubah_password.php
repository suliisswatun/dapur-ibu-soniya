<?php
include 'koneksi.php';

$username = $_GET['username'] ?? $_POST['username'] ?? '';
$showSuccess = false;
$showError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (strlen($password) < 6) {
        $showError = "Password minimal 6 karakter.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare("UPDATE admin SET password = ?, reset_token = NULL, reset_token_expired = NULL WHERE username = ?");
        $stmt->bind_param("ss", $hash, $username);
        if ($stmt->execute()) {
            $showSuccess = true;
        } else {
            $showError = "Gagal mengubah password. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/form.css" />
  <title>Ubah Password</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    <?php if ($showSuccess): ?>
      window.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: 'success',
          title: 'Password berhasil diubah!',
          text: 'Silakan login ke akun Anda.',
          showConfirmButton: true
        }).then(function() {
          window.location = 'login.php';
        });
      });
    <?php elseif (!empty($showError)): ?>
      window.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: '<?= addslashes($showError) ?>'
        });
      });
    <?php endif; ?>
  </script>
</head>
<body>
  <div class="container">
    <div class="green-section">
      <div class="inner-box">
        <img src="assets/img/1.png" alt="Ilustrasi" />
        <h1>Ubah Password</h1>
      </div>
    </div>
    <div class="form-section">
      <h2>Password Baru</h2>
      <form method="POST">
        <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
        <div class="form-group">
          <label for="password">Password Baru:</label>
          <input type="password" id="password" name="password" placeholder="Password baru" required />
        </div>
        <button type="submit" class="btn">Simpan</button>
      </form>
    </div>
  </div>
</body>
</html>
