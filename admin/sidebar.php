<?php include("../session.php"); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li>
                <a href="dashboardadmin.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-clock"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="datakeuangan.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-download"></i><span>Data Keuangan</span>
                </a>
            </li>
            <li>
                <a href="tabelmenu.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-home"></i><span>Menu</span>
                </a>
            </li>
            <li>
                <a href="pesanan.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-clipboard-list"></i><span>Tabel Pesanan</span>
                </a>
            </li>
            <li>
                <a href="riwayatlogin.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-clipboard-list"></i><span>Riwayat Login</span>
                </a>
            </li>
            <li>
                <a href="profile.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-user"></i><span>Profile</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <?php include 'topbar.php'; ?>
    
    <script>
        function toggleDropdown() {
            const dropdown = document.querySelector('.user-dropdown');
            dropdown.classList.toggle('show');
        }
    </script>
</body>
</html>
