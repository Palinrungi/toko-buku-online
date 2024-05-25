<html>
<head>
<link href="layout.css" rel="stylesheet" type="text/css" />
<title>Toko Buku Online</title>
</head>
<body>
<?php
include("dbconn.php");
$query = "SELECT KATEGORI_ID, KATEGORI_NAMA FROM KATEGORI ORDER BY KATEGORI_NAMA";
$result = mysqli_query($link, $query);
if ($result) {
?>
<ul>
<?php
while ($row = mysqli_fetch_array($result)) {
?>
<li>
<a href="daftarbuku.php?kat=<?php echo $row[0];?>" target="frmMain"><?php echo $row[1];?></a>
</li>
<?php
}
mysqli_free_result($result);
?>
</ul>
<?php
}
?>
</body>
</html>