<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stuk Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            text-align: center;
            color: #3498db;
        }

        p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Stuk Pembayaran</h1>

    <p><strong>Nama Pelanggan:</strong> {{ $detailPenjualan->penjualan->pelanggan->NamaPelanggan }}</p>
    <p><strong>Alamat:</strong> {{ $detailPenjualan->penjualan->pelanggan->Alamat }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $detailPenjualan->penjualan->pelanggan->NomorTelepon }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $detailPenjualan->produk->NamaProduk }}</td>
                <td>{{ $detailPenjualan->JumlahProduk }}</td>
                <td>{{ $detailPenjualan->Subtotal }}</td>
            </tr>
            <!-- Tambahkan baris lain sesuai kebutuhan -->
        </tbody>
    </table>

    <p><strong>Total Harga:</strong> Rp. {{ number_format($detailPenjualan->penjualan->Harga, 2, ',', '.') }}</p>

    <!-- Tambahkan elemen HTML atau informasi lainnya yang diperlukan -->

</body>
</html>
