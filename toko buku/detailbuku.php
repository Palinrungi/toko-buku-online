<html>
<head>
<title>Toko Buku Online</title>
<link href="framelayout.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include("dbconn.php");
$isbn = $_GET['isbn'];
?>
<h2>Detail Buku</h2>
<?php
$query = "
SELECT
    a.BUKU_ISBN,
    a.BUKU_JUDUL,
    c.PENGARANG_NAMA,
    b.PENERBIT_NAMA,
    a.BUKU_HARGA,
    a.BUKU_TGLTERBIT,
    a.BUKU_JMLHALAMAN,
    a.BUKU_DESKRIPSI
FROM
    BUKU a
JOIN
    PENERBIT b ON a.PENERBIT_ID = b.PENERBIT_ID
JOIN
    LINK_BUKU_PENGARANG d ON a.BUKU_ISBN = d.BUKU_ISBN
JOIN
    PENGARANG c ON c.PENGARANG_ID = d.PENGARANG_ID
WHERE
    a.BUKU_ISBN = '$isbn'";

$result = mysqli_query($link, $query);
if ($result && $row = mysqli_fetch_array($result)) {
    list($buku_isbn, $buku_judul, $pengarang_nama, $penerbit_nama, $buku_harga, $buku_tglterbit, $buku_jmlhalaman, $buku_deskripsi) = $row;
?>
<table class="buku">
<tr>
    <td width="200" align="left">ISBN</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($buku_isbn); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left">Judul</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($buku_judul); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left">Pengarang</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($pengarang_nama); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left">Penerbit</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($penerbit_nama); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left">Harga</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($buku_harga); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left">Tanggal Terbit</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($buku_tglterbit); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left">Jumlah Halaman</td>
    <td width="490" align="left"><strong><?php echo htmlspecialchars($buku_jmlhalaman); ?></strong></td>
</tr>
<tr>
    <td width="200" align="left" valign="top">Deskripsi</td>
    <td width="490" align="left"><?php echo nl2br(htmlspecialchars($buku_deskripsi)); ?></td>
</tr>
</table>
<?php
    mysqli_free_result($result);
} else {
    echo "<p>Buku tidak ditemukan.</p>";
}
?>
<p><input type="button" value="Pesan" onClick="document.location.href='pesan.php'"></p>
</body>
</html>