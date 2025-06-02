<?php include_once("../session.php"); ?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css?" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap4.css">
  </head>
  <body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
      <div class="content-wrapper">
        <h2>Riwayat Login</h2>
        <!-- Filter tanggal -->
        <form method="GET" class="form-inline mb-3">
          <label class="mr-2">Dari:</label>
          <input type="date" name="dari" class="form-control mr-2" required value="<?php echo $_GET['dari'] ?? date('Y-m-01'); ?>">
          <label class="mr-2">Sampai:</label>
          <input type="date" name="sampai" class="form-control mr-2" required value="<?php echo $_GET['sampai'] ?? date('Y-m-d'); ?>">
          <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Waktu Login</th>
                <th>IP Address</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              include('../koneksi.php');

              $dari = $_GET['dari'] ?? date('Y-m-01');
              $sampai = $_GET['sampai'] ?? date('Y-m-d');

              $query = "SELECT admin.nama, admin.username, logins.login_time, logins.ip_address 
                        FROM logins 
                        JOIN admin ON logins.id_admin = admin.id_admin
                        WHERE DATE(logins.login_time) BETWEEN '$dari' AND '$sampai'
                        ORDER BY logins.login_time DESC";
              
              $result = mysqli_query($koneksi, $query);
              $no = 1;
              while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$row['nama']."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['login_time']."</td>";
                echo "<td>".$row['ip_address']."</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
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