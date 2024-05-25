
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pesan.css">
    <title>Toko Buku</title>

    <script>
        function updateHarga() {
            const judulBuku = document.getElementById("judul_buku").value;
            fetch(`get_harga.php?judul=${judulBuku}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("harga_buku").value = data.harga;
                });
        }

        function updateHarga() {
            const judulBuku = document.getElementById("judul_buku").value;
            fetch(`get_harga.php?judul=${judulBuku}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("harga_buku").value = data.harga;
                    updateTotalHarga();
                });
        }

       function updateTotalHarga() {
            const hargaBuku = parseFloat(document.getElementById("harga_buku").value);
            const jumlahItem = parseInt(document.getElementById("jumlah_item").value);
            const totalHarga = hargaBuku * jumlahItem;
            document.getElementById("total_harga").value = totalHarga;
        }

         function showAllBookTitles() {
        fetch('get_all_book_titles.php')
            .then(response => response.json())
            .then(data => {
                const optionsDiv = document.getElementById('book_title_options');
                optionsDiv.innerHTML = '';
                if (data.length > 0) {
                    const selectList = document.createElement('select');
                    selectList.setAttribute('id', 'book_title_select');
                    data.forEach(title => {
                        const option = document.createElement('option');
                        option.value = title;
                        option.text = title;
                        selectList.appendChild(option);
                    });
                    optionsDiv.appendChild(selectList);
                    optionsDiv.style.display = 'block';
                } else {
                    optionsDiv.style.display = 'none';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    </script>
</head>
<body>
  <form action="submit_pembeli.php" method="POST">
        <label for="nama_pembeli">Nama Pembeli:</label>
        <input type="text" id="nama_pembeli" name="nama_pembeli" required><br><br>

        <label for="judul_buku">Judul Buku:</label>
        <input type="text" id="judul_buku" name="judul_buku" oninput="updateHarga()" required><br><br>

        <label for="jumlah_item">Jumlah Item:</label>
        <input type="number" id="jumlah_item" name="jumlah_item" oninput="updateTotalHarga()" required><br><br>

        <label for="harga_buku">Harga Buku:</label>
        <input type="text" id="harga_buku" name="harga_buku" readonly><br><br>

        <label for="total_harga">Total Harga:</label>
        <input type="text" id="total_harga" name="total_harga" readonly><br><br>

        <button type="submit">Submit</button>
    </form><br><br>
    <a href="data_pembeli.php">Lihat Data Pembeli</a>

</body>
</html>