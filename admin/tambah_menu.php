<?php
include_once("../session.php");
include('../koneksi.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Menu</title>
        <style>
        /* body {
    margin: 0;
    font-family: Arial, sans-serif;
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
}

.sidebar button:hover {
    background-color: #e7e7e7;
} */
body {
    
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    color: #333;
}

/* Center the header */
h1 {
    text-align: center;
    color: #4CAF50;
}

/* Style the form section */
.base {
    max-width: 400px;
    margin-top:40;
    margin: 20px auto;
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
}


/* Style the labels */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Style the input fields */
input[type="text"], input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style the submit button */
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

/* Button hover effect */
button:hover {
    background-color: #45a049;
}

</style>
    </head>
    <body>
        <center><h1>Tambah Menu</h1></center>
        <form method="POST" action="proses_tambah.php" enctype="multipart/form-data">
            <section class="base">
                <div>
                    <label>Nama Menu</label>
                    <input type="text" name="nama_menu" required="" />
                </div>
                <div>
                    <label>Jenis Menu</label>
                    <select name="jenis_menu" required>
                        <option value="">-- Pilih Jenis Menu --</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Cemilan">Cemilan</option>
                    </select>
                </div>
                <div>
                    <label>Harga</label>
                    <input type="text" name="harga" required="" />
                </div>
                <div>
                    <label>Foto Menu</label>
                    <input type="file" name="foto_menu" autofocus="" required="" />
                </div>
                <div>
                    <button type="submit">Simpan Daftar Menu</button>
                </div>
            </section>
        </form>
    </body>
</html>