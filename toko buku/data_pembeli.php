<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pembeli</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <h1>Data Pembeli</h1>
    <table border="1">
        <tr>
            <th>ID Pembeli</th>
            <th>Nama Pembeli</th>
            <th>Judul Buku</th>
            <th>Jumlah Item</th>
            <th>Harga Buku</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Koneksi ke database
        $conn = new mysqli('localhost', 'root', '', 'toko_buku');

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil data pembeli dari database
        $sql = "SELECT * FROM pembeli";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Tampilkan data pembeli ke dalam tabel
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["ID_Pembeli"]."</td>";
                echo "<td>".$row["Nama_Pembeli"]."</td>";
                echo "<td>".$row["Buku_Judul"]."</td>";
                echo "<td>".$row["Jumlah_Item"]."</td>";
                echo "<td>Rp ".number_format($row["Buku_Harga"], 2, ',', '.')."</td>";
                echo "<td>Rp ".number_format($row["total_harga"], 2, ',', '.')."</td>";
                echo "<td>";
                echo "<a href='edit.php?id=".$row["ID_Pembeli"]."'>Edit</a> | ";
                echo "<a href='delete.php?id=".$row["ID_Pembeli"]."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data pembeli</td></tr>";
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </table>
    <br><br>
    <a href="pesan.php">Pesan Buku</a>
</body>
</html>
