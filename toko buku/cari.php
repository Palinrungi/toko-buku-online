<!DOCTYPE html>
<html>
<head>
    <title>Toko Buku Online</title>
    <link href="framelayout.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php
    include("dbconn.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $btnCari = $_POST['btnCari'];
        if (!isset($btnCari)) {
            exit();
        }

        $comboCari = $_POST['comboCari'];
        $txtCari = $_POST['txtCari'];
        $label = "";
        $str = "";

        switch ($comboCari) {
            case 0:
                $label = "Hasil pencarian buku <u>berdasarkan judul</u> <strong>$txtCari</strong>:";
                $str = "upper(a.buku_judul) like upper('%$txtCari%')";
                break;
            case 1:
                $label = "Hasil pencarian buku berdasarkan <u>nama pengarang</u> <strong>$txtCari</strong>:";
                $str = "upper(c.pengarang_nama) like upper('%$txtCari%')";
                break;
            case 2:
                $label = "Hasil pencarian buku berdasarkan <u>nama penerbit</u> <strong>$txtCari</strong>:";
                $str = "upper(b.penerbit_nama) like upper('%$txtCari%')";
                break;
        }

        echo "<h2>Hasil Pencarian Buku</h2>";
        echo "<p>$label</p>";
        echo "<br />";

        $query = "SELECT DISTINCT
            a.BUKU_ISBN,
            a.BUKU_JUDUL,
            b.PENERBIT_NAMA,
            a.BUKU_HARGA
            FROM
            BUKU a,
            PENERBIT b,
            PENGARANG c,
            LINK_BUKU_PENGARANG d
            WHERE
            a.PENERBIT_ID = b.PENERBIT_ID AND
            a.BUKU_ISBN = d.BUKU_ISBN AND
            c.PENGARANG_ID = d.PENGARANG_ID AND
            $str";

        $result = mysqli_query($link, $query);
        if ($result) {
            echo '<table class="buku">
            <tr>
                <th width="50">ISBN</th>
                <th width="280">Judul</th>
                <th width="150">Penerbit</th>
                <th width="80">Harga</th>
                <th>Detail</th>
            </tr>';

            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td align="left">' . $row[1] . '</td>
                    <td align="left">' . $row[2] . '</td>
                    <td align="right">' . 'Rp ' . number_format($row[3], 0, "", ".") . '</td>
                    <td><a href="detailbuku.php?isbn=' . $row[0] . '">Lihat Detail</a></td>
                </tr>';
            }

            echo '</table>';
            mysqli_free_result($result);
        } else {
            echo 'Pencarian tidak berhasil.';
        }
    }
    ?>
</body>
</html>