<?php
include("dbconn.php"); // Menggunakan titik koma (;) bukan titik (:) untuk include file

function getKategori($id) { // Menggunakan kurung kurawal {} untuk membungkus fungsi
    global $link;
    $query = "SELECT
                KATEGORI_NAMA 
              FROM
                KATEGORI
              WHERE
                KATEGORI_ID = $id"; // Mengubah KATEGORI ID menjadi KATEGORI_ID
    $namakategori = "";
    $result = mysqli_query($link, $query);
    if ($result) {
        list($namakategori) = mysqli_fetch_array($result); // Menambahkan kurung kurawal {} dan titik koma (;)
        mysqli_free_result($result);
    }
    return $namakategori;
}
?>