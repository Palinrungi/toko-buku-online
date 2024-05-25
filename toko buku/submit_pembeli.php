<?php
// Membuat koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_buku');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pembeli = $conn->real_escape_string($_POST['nama_pembeli']);
    $judul_buku = $conn->real_escape_string($_POST['judul_buku']);
    $jumlah_item = intval($_POST['jumlah_item']);
    $harga_buku = floatval($_POST['harga_buku']);
    $total_harga = floatval($_POST['total_harga']);

    $sql = "INSERT INTO pembeli (Nama_Pembeli, Buku_Judul, Jumlah_Item, Buku_Harga, total_harga) 
            VALUES ('$nama_pembeli', '$judul_buku', $jumlah_item, $harga_buku, $total_harga)";

    if ($conn->query($sql) === TRUE) {
        echo "Data pembeli berhasil dimasukkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>