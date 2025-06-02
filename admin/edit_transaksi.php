<?php
include("../koneksi.php");


// Pastikan ID transaksi ada di URL
if (isset($_GET["id_keuangan"])) {
    $id_keuangan = $_GET["id_keuangan"];
    $query = "SELECT * FROM data_keuangan WHERE id_keuangan = '$id_keuangan'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Transaksi tidak ditemukan!'); window.location='datakeuangan.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID Transaksi tidak diberikan!'); window.location='datakeuangan.php';</script>";
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
    <!DOCTYPE html>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2ecc71;
            color: white;
            padding: 20px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.5);
        }

        .sidebar h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar button {
            background-color: white;
            color: #4CAF50;
            border: none;
            padding: 10px 15px;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            text-align: left;
        }

        .sidebar button:hover {
            background-color: #e7e7e7;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .base {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            justify-content: center;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
        </style>
</head>
<body>
    <center><h1>Edit Transaksi</h1></center>
     <div class="main-content">
    <div class="content-wrapper">
        
     <section class="base">

         <form method="POST" action="prosesedit_transaksi.php" enctype="multipart/form-data">
             <input type="hidden" name="id_keuangan" value="<?php echo $data['id_keuangan']; ?>">
             
             <label>Tanggal & Waktu:</label>
             <input type="datetime-local" name="tanggal_transaksi" value="<?php echo date('Y-m-d\TH:i', strtotime($data['tanggal_transaksi'])); ?>" required><br>
             
             <label>Jenis:</label>
             <select name="jenis">
                 <option value="Pemasukan" <?php if ($data['jenis'] == "Pemasukan") echo "selected"; ?>>Pemasukan</option>
                 <option value="Pengeluaran" <?php if ($data['jenis'] == "Pengeluaran") echo "selected"; ?>>Pengeluaran</option>
                </select><br>
                
                <label>Catatan:</label>
                <input type="text" name="catatan" value="<?php echo $data['catatan']; ?>" required><br>
                
                <label>Jumlah:</label>
                <input type="number" name="jumlah" value="<?php echo $data['jumlah']; ?>" required><br>
                
                <button type="submit">Simpan Perubahan</button>
            </form>
    </div>
     </div>
        </section>
</body>
</html>
