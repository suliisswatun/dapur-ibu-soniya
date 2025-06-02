<?php
include("../koneksi.php");

// Pastikan tidak ada spasi, newline, atau output sebelum header
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=datakeuangan.xls");

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Tanggal & Waktu</th>
        <th>Jenis</th>
        <th>Catatan</th>
        <th>Jumlah</th>
      </tr>";

$query = "SELECT * FROM data_keuangan ORDER BY id_keuangan ASC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo "<tr><td colspan='5'>Query error: " . mysqli_error($koneksi) . "</td></tr>";
    echo "</table>";
    exit;
}

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . date("d-m-Y H:i:s", strtotime($row['tanggal_transaksi'])) . "</td>";
    echo "<td>" . $row['jenis'] . "</td>";
    echo "<td>" . $row['catatan'] . "</td>";
    echo "<td>" . $row['jumlah'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
