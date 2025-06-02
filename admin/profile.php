<?php
include '../koneksi.php';
session_start();
$id_admin = isset($_SESSION['id_admin']) ? $_SESSION['id_admin'] : 1;

$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin= $id_admin");
$data = mysqli_fetch_assoc($query);

// Cek apakah password terenkripsi
$password_value = (strlen($data['password']) > 30 && strpos($data['password'], '$2y$') === 0) ? '' : htmlspecialchars($data['password']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css?" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap4.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
      <div class="content-wrapper">
        <h2>Profil Admin</h2>
      <!-- Tampilan Awal Profil -->
      <div class="profile-card" id="viewProfile">
        <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama']); ?></p>
        <p><strong>Username:</strong> <?= htmlspecialchars($data['username']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($data['email']); ?></p>
        <button onclick="showEditForm()" class="btn btn-primary">Edit Profil</button>
      </div>
      <!-- Form Edit Profil (disembunyikan awalnya) -->
      <div class="profile-card" id="editProfileForm" style="display: none;">
        <form action="proses_edit_profil.php" method="POST">
          <input type="hidden" name="id" value="<?= $data['id_admin']; ?>">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" name="username" value="<?= htmlspecialchars($data['username']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" id="password" class="form-control" name="password" />
            <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" onclick="cancelEdit()">Batal</button>
        </form>
      </div>
      </div>
    </div>
    <script src="../assets/js/hamburgermenu.js"></script>
    <script src="../assets/js/dropdownuser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script>
    function showEditForm() {
      document.getElementById('viewProfile').style.display = 'none';
      document.getElementById('editProfileForm').style.display = 'block';
    }
    function cancelEdit() {
      document.getElementById('editProfileForm').style.display = 'none';
      document.getElementById('viewProfile').style.display = 'block';
    }
  </script>
</body>
</html>