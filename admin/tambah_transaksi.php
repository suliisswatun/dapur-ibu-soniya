<?php
include("../koneksi.php");
?>
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html>

    <title>Tambah Transaksi</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
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
    <div class="main-content">
    <div class="content-wrapper">
        
        <form method="POST" action="prosestambah_transaksi.php" enctype="multipart/form-data">
       <center><h1>Tambah Transaksi</h1></center>
       <section class="base">

           <label>Tanggal Transaksi:</label>
           <input type="datetime-local" name="tanggal_transaksi" required><br>
           
           <label>Jenis:</label>
           <select name="jenis">
               <option value="Pemasukan">Pemasukan</option>
               <option value="Pengeluaran">Pengeluaran</option>
            </select><br>
            
            <label>Catatan:</label>
            <input type="text" name="catatan" required><br>
            
            <label>Jumlah:</label>
            <input type="number" name="jumlah" required><br>
            
            <button type="submit">Tambah</button>
        </form>
    </section>
     
</div>
    </div>
</body>
</html>
