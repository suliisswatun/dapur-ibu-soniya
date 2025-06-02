<?php include("../koneksi.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Keuangan</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css?" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    
       
    </style> -->
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="main-content">
    <div class="content-wrapper">
        <h2>Data Keuangan</h2>
        <!-- Tombol Tambah Transaksi -->
<div class="d-flex mb-3" style="gap: 10px;">
    <a href="tambah_transaksi.php" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Tambah Transaksi
    </a>

    <button onclick="window.open('laporan_excel.php')" class="btn btn-success mb-3">
        <i class="fa-solid fa-file-export"></i> Export Excel
    </button>
</div>





        <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal & Waktu</th>
                    <th>Jenis</th>
                    <th>Catatan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM data_keuangan ORDER BY id_keuangan ASC";
                $result = mysqli_query($koneksi, $query);
                if (!$result) {
                    die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date("d-m-Y H:i:s", strtotime($row['tanggal_transaksi'])); ?></td> <!-- Menampilkan tanggal dan waktu -->
                    <td><?php echo $row['jenis']; ?></td>
                    <td><?php echo $row['catatan']; ?></td>
                    <td>Rp <?php echo number_format((float)$row['jumlah'], 0, ',', '.'); ?></td> <!-- Format jumlah -->
                    <td class="action-icons"> <!-- Pastikan kolom aksi berada di posisi yang benar -->
                        <a href="edit_transaksi.php?id_keuangan=<?php echo $row['id_keuangan']; ?>"><i class="fas fa-pen-to-square"></i></a>
                        <a href="hapus_transaksi.php?id_keuangan=<?php echo $row['id_keuangan']; ?>" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                $no++;
                }
                ?>
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
