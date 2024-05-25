<?php
// Membuat koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_buku');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['judul'])) {
    $judul = $conn->real_escape_string($_GET['judul']);
    $sql = "SELECT BUKU_HARGA FROM BUKU WHERE BUKU_JUDUL = '$judul'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['harga' => $row['BUKU_HARGA']]);
    } else {
        echo json_encode(['harga' => 0]);
    }
}

$conn->close();
?>