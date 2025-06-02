<?php
session_start();
include_once("koneksi.php");

// Fungsi untuk ambil IP address yang akurat
function getUserIP() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    return $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
  } else {
    return ($_SERVER['REMOTE_ADDR'] === '::1') ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
  }
}

// Jika pengguna sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['username'])) {
  header("Location: admin/dashboardadmin.php");
  exit();
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query untuk memeriksa username dalam tabel admin
  $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $data = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $data['password'])) {
      // Set session untuk login
      $_SESSION['username'] = $data['username'];
      $_SESSION['id_admin'] = $data['id_admin'];

      // Ambil IP address user dengan fungsi
      $ip_address = getUserIP();

      // Simpan ke tabel logins
      $login_stmt = $koneksi->prepare("INSERT INTO logins (id_admin, ip_address) VALUES (?, ?)");
      $login_stmt->bind_param("is", $data['id_admin'], $ip_address);
      $login_stmt->execute();

      // Simpan cookie jika checkbox dicentang
      if (!empty($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 30), "/");
        setcookie('password', $password, time() + (86400 * 30), "/");
      } else {
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
      }

      header("Location: admin/dashboardadmin.php");
      exit();
    } else {
      $error = "Password salah.";
    }
  } else {
    $error = "Username tidak ditemukan.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
  <div class="container">
    <div class="green-section">
      <div class="inner-box">
        <img src="assets/img/1.png" alt="Illustration" />
        <h1>Halaman Login</h1>
      </div>
    </div>
    <div class="form-section">
      <h2>Halo!</h2>
      <p>Kami senang Anda kembali</p>

      <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
      <?php endif; ?>

      <form method="POST" action="" id="loginForm">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required 
          value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required 
          value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>">
        </div>
        <div class="remember-group">
          <div>
            <input type="checkbox" id="remember" name="remember" 
            <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>>
            <label for="remember">Simpan Password</label>
          </div>
          <a href="lupapassword.php">Lupa Password?</a>
        </div>
        <button type="submit" name="login" class="btn">Login</button>
      </form>

      <div class="register-link">
        Belum punya akun? <a href="register.php">Daftar Sekarang</a>
      </div>
    </div>
  </div>
</body>
</html>
