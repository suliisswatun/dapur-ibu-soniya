<?php 
session_start();
$message = "";
$showSuccess = false;

if(isset($_POST['register'])) {
  // Sanitasi input
  $nama     = htmlspecialchars(trim($_POST['nama']));
  $username = htmlspecialchars(trim($_POST['username']));
  $password = $_POST['password']; // password jangan di htmlspecialchars supaya hash benar
  $email    = htmlspecialchars(trim($_POST['email']));
  $wa       = htmlspecialchars(trim($_POST['wa'])); // tambahkan ini

  // Validasi field tidak kosong
  if($nama !== '' && $username !== '' && $password !== '' && $email !== '' && $wa !== '') {

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message = "<div class='alert alert-warning'>Format email tidak valid.</div>";
    }
    // Validasi panjang password minimal 6 karakter
    elseif(strlen($password) < 6) {
      $message = "<div class='alert alert-warning'>Password minimal 6 karakter.</div>";
    } else {
      include_once('koneksi.php');

      // Cek username sudah ada atau belum
      $stmtUser = $koneksi->prepare("SELECT id_admin FROM admin WHERE username = ?");
      $stmtUser->bind_param("s", $username);
      $stmtUser->execute();
      $stmtUser->store_result();

      if($stmtUser->num_rows > 0) {
        $message = "<div class='alert alert-danger'>Username sudah digunakan.</div>";
      } else {
        // Cek email sudah ada atau belum
        $stmtEmail = $koneksi->prepare("SELECT id_admin FROM admin WHERE email = ?");
        $stmtEmail->bind_param("s", $email);
        $stmtEmail->execute();
        $stmtEmail->store_result();

        if($stmtEmail->num_rows > 0) {
          $message = "<div class='alert alert-danger'>Email sudah digunakan.</div>";
          $stmtEmail->close();
        } else {
          $stmtEmail->close();

          // Hash password
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          // Insert admin baru (tambahkan kolom no_wa)
          $stmtInsert = $koneksi->prepare("INSERT INTO admin (nama, username, password, email, no_wa) VALUES (?, ?, ?, ?, ?)");
          $stmtInsert->bind_param("sssss", $nama, $username, $hashedPassword, $email, $wa);

          if($stmtInsert->execute()) {
            $showSuccess = true;
          } else {
            $message = "<div class='alert alert-danger'>Gagal mendaftar. Silakan coba lagi.</div>";
          }
          $stmtInsert->close();
        }
      }
      $stmtUser->close();
    }
  } else {
    $message = "<div class='alert alert-warning'>Semua field harus diisi!</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/form.css?" />
    <style>
      .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
      }
      .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
      }
      .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
      }
      .alert-warning {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Halaman Registrasi</title>
  </head>
  <body>
    <?php if($showSuccess): ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Pendaftaran Berhasil!',
          text: 'Silakan login ke akun Anda.',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout(function(){ window.location='login.php'; }, 2000);
      </script>
    <?php endif; ?>
    <div class="container">
      <div class="green-section">
        <div class="inner-box">
          <img src="assets/img/1.png" alt="Illustration" />
          <h1>Halaman Registrasi</h1>
        </div>
      </div>
      <div class="form-section">
        <h2>Halo!</h2>
        <p>Silakan daftar untuk membuat akun baru</p>
        <?php if($message): ?>
          <?php echo $message; ?>
        <?php endif; ?>
        <form method="POST" name="register" action="">
          <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required />
          </div>
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Masukkan Username" required />
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password" required />
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Masukkan Email" required />
          </div>
          <div class="form-group">
            <label for="wa">No. WhatsApp:</label>
            <input type="text" id="wa" name="wa" placeholder="08xxxxxxxxxx" required />
          </div>
          <button type="submit" name="register" class="btn">Daftar</button>
        </form>
        <div class="register-link">
          Sudah punya akun? <a href="login.php">Login Sekarang</a>
        </div>
      </div>
    </div>
  </body>
</html>