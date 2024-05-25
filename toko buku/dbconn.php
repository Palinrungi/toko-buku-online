<?php
$host = "127.0.0.1";
$dbusername = "root"; // Mengganti tanda - menjadi =
$dbpassword = "";
$dbname = "toko_buku"; // Menambahkan tanda = untuk menyimpan nilai

$link = mysqli_connect($host, $dbusername, $dbpassword, $dbname); // Menambahkan parameter dbname
if (mysqli_connect_errno()) {
    echo "Koneksi ke server MySQL gagal: " . mysqli_connect_error(); // Menambahkan pesan error
    exit(); // Menghentikan eksekusi script jika koneksi gagal
} else {
    // echo "Koneksi ke server MySQL sukses"; // Komentar ini dapat dihapus atau digunakan untuk debug
}
?>