<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_buku');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data pembeli berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pembeli WHERE ID_Pembeli=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_pembeli = $row['Nama_Pembeli'];
        $judul_buku = $row['Buku_Judul'];
        $jumlah_item = $row['Jumlah_Item'];
        $harga_buku = $row['Buku_Harga'];
        $total_harga = $row['total_harga'];
    } else {
        echo "Data tidak ditemukan.";
    }
}

// Perbarui data pembeli
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $judul_buku = $_POST['judul_buku'];
    $jumlah_item = $_POST['jumlah_item'];
    $harga_buku = $_POST['harga_buku'];
    $total_harga = $_POST['total_harga'];

    $sql = "UPDATE pembeli SET Nama_Pembeli='$nama_pembeli', Buku_Judul='$judul_buku', Jumlah_Item='$jumlah_item', Buku_Harga='$harga_buku', total_harga='$total_harga' WHERE ID_Pembeli=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pembeli</title>
</head>
<body>
    <h1>Edit Data Pembeli</h1>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Nama Pembeli:</label><br>
        <input type="text" name="nama_pembeli" value="<?php echo $nama_pembeli; ?>"><br>
        <label>Judul Buku:</label><br>
        <input type="text" name="judul_buku" value="<?php echo $judul_buku; ?>"><br>
        <label>Jumlah Item:</label><br>
        <input type="number" name="jumlah_item" value="<?php echo $jumlah_item; ?>"><br>
        <label>Harga Buku:</label><br>
        <input type="number" name="harga_buku" value="<?php echo $harga_buku; ?>"><br>
        <label>Total Harga:</label><br>
        <input type="number" name="total_harga" value="<?php echo $total_harga; ?>"><br><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
