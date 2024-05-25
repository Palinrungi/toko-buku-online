<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_buku');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hapus data pembeli berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pembeli WHERE ID_Pembeli=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();

// Redirect kembali ke halaman utama
header('Location: index.php');
?>

