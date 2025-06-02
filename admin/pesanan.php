<?php
include_once("../session.php");
include '../koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Antrian Pesanan</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap4.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
 <?php include 'sidebar.php'; ?>
<div class="main-content">
    <div class="content-wrapper">
        <h2>Pesanan</h2>
        <div class="content-wrapper" style="margin-bottom:40px;">
            <h3 style="color: #333;">Antrian Aktif</h3>
            <a href="tambahpesanan.php" id="btn-tambah-menu">
                <i class="fas fa-plus"></i>
                <span>Tambah Pesanan</span>
            </a>
            <div class="table-responsive">
                <table id="tabel-antrian" class="table table-striped table-bordered">
                    <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_antrian = "SELECT pesanan.*, menu.nama_menu, menu.harga FROM pesanan 
                                      JOIN menu ON pesanan.id_menu = menu.id_menu 
                                      WHERE pesanan.status != 'selesai'
                                      ORDER BY waktu_pesan ASC";
                    $result = mysqli_query($koneksi, $query_antrian);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_pemesan']}</td>
                                <td>{$row['nama_menu']}</td>
                                <td>{$row['harga']}</td>
                                <td>{$row['jumlah_pesanan']}</td>
                                <td>Rp" . number_format($row['total_harga'], 0, ',', '.') . "</td>
                                <td>{$row['status']}</td>
                                <td>{$row['waktu_pesan']}</td>
                                <td>
                                    <button type='button' class='btn-edit-menu' onclick=\"location.href='editpesanan.php?id={$row['id_pesanan']}'\" title='Edit'>
                                        <i class='fas fa-pen-to-square'></i>
                                    </button>
                                    <button type='button' class='btn-hapus-menu' onclick=\"if(confirm('Yakin?')){location.href='hapuspesanan.php?id={$row['id_pesanan']}'}\" title='Hapus'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </td>
                              </tr>";
                        $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-wrapper">
            <h3 style="color: #333;">Pesanan Sudah Dilayani</h3>
            <div class="table-responsive">
                <table id="tabel-selesai" class="table table-striped table-bordered">
                    <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_selesai = "SELECT pesanan.*, menu.nama_menu, menu.harga FROM pesanan 
                                      JOIN menu ON pesanan.id_menu = menu.id_menu 
                                      WHERE pesanan.status = 'selesai'
                                      ORDER BY waktu_pesan ASC";
                    $result_selesai = mysqli_query($koneksi, $query_selesai);
                    $no_selesai = 1;
                    while ($row = mysqli_fetch_assoc($result_selesai)) {
                        echo "<tr>
                                <td>{$no_selesai}</td>
                                <td>{$row['nama_pemesan']}</td>
                                <td>{$row['nama_menu']}</td>
                                <td>{$row['harga']}</td>
                                <td>{$row['jumlah_pesanan']}</td>
                                <td>Rp" . number_format($row['total_harga'], 0, ',', '.') . "</td>
                                <td>{$row['status']}</td>
                                <td>{$row['waktu_pesan']}</td>
                              </tr>";
                        $no_selesai++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../assets/js/hamburgermenu.js"></script>
    <script src="../assets/js/dropdownuser.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script>
      $(document).ready(function() {
        $('#tabel-antrian').DataTable();
        $('#tabel-selesai').DataTable();
      });
    </script>
</body>
</html>