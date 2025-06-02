<?php include_once("../session.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>

    <link rel="stylesheet" href="../assets/css/dashboard.css?" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap4.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
      <div class="content-wrapper">
    <h2>Menu</h2>
   <button type="button" onclick="location.href='tambah_menu.php'" 
  style="background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; margin-bottom: 15px; width: 17%; display: inline-flex; align-items: center; gap: 6px;">
  <i class="fas fa-plus"></i>Tambah Menu
</button>


     
    <?php
    include('../koneksi.php');
    // Ganti detail_pesanan ke pesanan jika memang tidak ada tabel detail_pesanan
    $query = "
      SELECT 
          m.*
      FROM menu m
      ORDER BY m.id_menu ASC
    ";
    $result = mysqli_query($koneksi, $query);
    ?>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto Menu</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Jenis Menu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                  <img src="../foto_menu/<?= htmlspecialchars($row['foto_menu']) ?>" alt="Foto Menu" style="max-width:180px; max-height:80px; object-fit:cover;">
                </td>
                <td><?= htmlspecialchars($row['nama_menu']) ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?= !empty($row['jenis_menu']) ? htmlspecialchars($row['jenis_menu']) : '-' ?></td>
                <td>
                  <button type="button" class="btn-edit-menu" onclick="location.href='edit_menu.php?id_menu=<?= $row['id_menu'] ?>'">
                    <i class="fas fa-pen-to-square"></i> 
                  </button> |
                  <button type="button" class="btn-hapus-menu" onclick="if(confirm('Anda yakin ingin menghapus data ini?')){location.href='proses_hapus.php?id_menu=<?= $row['id_menu'] ?>'}">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
      </div>
    </div>
    <script src="../assets/js/hamburgermenu.js"></script>
    <script src="../assets/js/dropdownuser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable();
      });
    </script>
</body>
</html>