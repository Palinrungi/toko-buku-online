<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Buku Online</title>
    <link href="framelayout.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="tabel">
    <?php
    include("dbconn.php");
    include("fungsi.php");
    
    // Get the category ID from the URL
    $idkategori = $_GET['kat'];
    $namakategori = getKategori($idkategori);
    ?>
    
    <h2>Daftar Buku <?php echo $namakategori; ?></h2>
    
    <?php
    // Define the query to get books based on the category
    $query = "SELECT
                a.BUKU_ISBN,
                a.BUKU_JUDUL,
                b.PENERBIT_NAMA,
                a.BUKU_HARGA
              FROM
                BUKU a,
                PENERBIT b,
                LINK_BUKU_KATEGORI c
              WHERE
                a.PENERBIT_ID = b.PENERBIT_ID AND
                a.BUKU_ISBN = c.BUKU_ISBN AND
                c.KATEGORI_ID = $idkategori";
    
    // Execute the query
    $result = mysqli_query($link, $query);
    
    if ($result) {
    ?>
    <table class="buku">
        <tr>
            <th width="50">ISBN</th>
            <th width="280">Judul</th>
            <th width="150">Penerbit</th>
            <th width="80">Harga</th>
            <th>Detail</th>
        </tr>
        <?php
        // Fetch and display the results
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $row['BUKU_ISBN']; ?></td>
            <td align="left"><?php echo $row['BUKU_JUDUL']; ?></td>
            <td align="left"><?php echo $row['PENERBIT_NAMA']; ?></td>
            <td align="right">
                <?php echo "Rp " . number_format($row['BUKU_HARGA'], 0, "", ".") . ",-"; ?>
            </td>
            <td><a href="detailbuku.php?isbn=<?php echo $row['BUKU_ISBN']; ?>">Lihat Detail</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
        // Free the result set
        mysqli_free_result($result);
    } else {
        echo "Tidak ada buku yang ditemukan.";
    }
    ?>
    </div>
</body>
</html>