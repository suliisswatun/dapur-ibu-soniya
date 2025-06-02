<?php 
include_once("../session.php"); 
include("../koneksi.php");



// Ambil total pemasukan
$queryPemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM data_keuangan WHERE jenis = 'Pemasukan'";
$resultPemasukan = mysqli_query($koneksi, $queryPemasukan);
$dataPemasukan = mysqli_fetch_assoc($resultPemasukan);
$totalPemasukan = $dataPemasukan['total_pemasukan'] ?? 0;

// Ambil total pengeluaran
$queryPengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM data_keuangan WHERE jenis = 'Pengeluaran'";
$resultPengeluaran = mysqli_query($koneksi, $queryPengeluaran);
$dataPengeluaran = mysqli_fetch_assoc($resultPengeluaran);
$totalPengeluaran = $dataPengeluaran['total_pengeluaran'] ?? 0;

// Ambil total pesanan
$queryPesanan = "SELECT COUNT(*) AS total_pesanan FROM pesanan";
$resultPesanan = mysqli_query($koneksi, $queryPesanan);
$dataPesanan = mysqli_fetch_assoc($resultPesanan);
$totalPesanan = $dataPesanan['total_pesanan'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css?" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <div class="main-content">
    <div class="dashboard">
      <h1>Dashboard</h1>
      <div class="cards">
        <div class="card yellow">
          <div class="card-content">
            <div>
              <p>Rp. <?php echo number_format($totalPemasukan, 0, ',', '.'); ?></p>
              <span>Total Pemasukan</span>
            </div>
            <div class="card-icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>
        <div class="card blue">
          <div class="card-content">
            <div>
              <p>Rp. <?php echo number_format($totalPengeluaran, 0, ',', '.'); ?></p>
              <span>Total Pengeluaran</span>
            </div>
            <div class="card-icon">
              <i class="fas fa-arrow-down"></i>
            </div>
          </div>
        </div>
        <div class="card dark">
          <div class="card-content">
            <div>
              <p><?php echo $totalPesanan; ?></p>
              <span>Total Pesanan</span>
            </div>
            <div class="card-icon">
              <i class="fas fa-file-alt"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="charts-section">
        <div class="chart-box">
          <h2>Pemasukan & Pengeluaran</h2>
          <canvas id="financeChart" width="400" height="200"></canvas>
        </div>
        <!-- Bagian menu terbaru tetap ditampilkan -->
        <div class="menu-box">
  <h2>Menu yang baru ditambahkan</h2>
  <table style="border-collapse: collapse; width: 100%;">
    <thead>
      <tr>
        <th style="border: 1px solid #ddd; background-color:#4CAF50; color:white;">No</th>
        <th style="border: 1px solid #ddd; background-color:#4CAF50; color:white;">Menu</th>
        <th style="border: 1px solid #ddd; background-color:#4CAF50; color:white;">Harga</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include('../koneksi.php');
      $query = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY id_menu DESC LIMIT 5");
      $no = 1;
      while ($data = mysqli_fetch_assoc($query)) {
          echo "<tr>";
          echo "<td style='border: 1px solid #ddd;'>" . $no++ . "</td>";
          echo "<td style='border: 1px solid #ddd;'>" . htmlspecialchars($data['nama_menu']) . "</td>";
          echo "<td style='border: 1px solid #ddd;'>Rp " . number_format($data['harga'], 0, ',', '.') . "</td>";
          echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/hamburgermenu.js"></script>
  <script src="../assets/js/dropdownuser.js"></script>
  <script>
    const ctx = document.getElementById("financeChart").getContext("2d");

    const financeChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: [
          "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
          "Jul", "Agu", "Sep", "Okt", "Nov", "Des",
        ],
        datasets: [
          {
            label: "Pemasukan",
            data: [30, 45, 60, 70, 50, 45, 60, 70, 50, 60, 40, 70],
            backgroundColor: "#2ecc71",
          },
          {
            label: "Pengeluaran",
            data: [-20, -30, -35, -30, -25, -35, -40, -30, -20, -30, -25, -35],
            backgroundColor: "#e74c3c",
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return "Rp. " + Math.abs(value) + "k";
              },
            },
          },
        },
      },
    });
  </script>
</body>
</html>
