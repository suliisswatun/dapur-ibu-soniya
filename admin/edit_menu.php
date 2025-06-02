<?php 
include('../koneksi.php'); 



if (isset($_GET['id_menu'])) {
    $id_menu = $_GET['id_menu'];
    $query = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
    $result = mysqli_query($koneksi, $query);
    
    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
    
    $data = mysqli_fetch_assoc($result);
    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada tabel.');window.location='tabelmenu.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Masukkan ID yang ingin diedit.');window.location='tabelmenu.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
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
    background-color: #4CAF50;
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
    transition: 0.3s ease;
}

.sidebar button:hover {
    background-color: #e7e7e7;
}

h1 {
    text-align: center;
    color: #4CAF50;
}

.base {
    max-width: 450px;
    margin: 40px auto;
    padding: 25px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    width: 100%;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="text"], input[type="file"], select {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s ease;
}

button:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

        </style>
</head>
<body>
    <center>
        <h1>Edit Menu</h1>
    </center>
    <div class="base">
        <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
            <!-- Kirim ID tersembunyi -->
            <input type="hidden" name="id_menu" value="<?php echo $data['id_menu']; ?>">

            <label>Nama Menu</label>
            <input type="text" name="nama_menu" value="<?php echo $data['nama_menu']; ?>" required>

            <label>Harga</label>
            <input type="text" name="harga" value="<?php echo $data['harga']; ?>" required>

            <label>Foto Menu (kosongkan jika tidak diubah)</label>
            <input type="file" name="foto_menu">

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
