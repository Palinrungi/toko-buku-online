<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_buku');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil semua judul buku dari database
$sql = "SELECT BUKU_JUDUL FROM BUKU";
$result = $conn->query($sql);

$titles = [];
if ($result->num_rows > 0) {
    // Masukkan judul buku ke dalam array
    while($row = $result->fetch_assoc()) {
        $titles[] = $row["BUKU_JUDUL"];
    }
}

// Mengirimkan judul buku dalam format JSON
echo json_encode($titles);

// Tutup koneksi
$conn->close();
?>