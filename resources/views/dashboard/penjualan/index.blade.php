@extends('layouts.app')
@section('title', 'Transaksi Penjualan')

@section('title-header', 'Transaksi Penjualan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transaksi Penjualan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
<!-- Tabel Produk -->
<div class="card shadow">
    <div class="card-header bg-transparent border-0 text-dark">
        <h2 class="card-title h3">Daftar Produk</h2>
    </div>
    <div class="card-body">
        <table class="table table-flush table-hover">
            <!-- Header Tabel -->
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- Data Produk -->
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $produk->NamaProduk }}</td>
                        <!-- <td>{{ $produk->Harga }}</td> -->
                        <td>Rp. {{ number_format($produk->Harga, 2, ',', '.') }}</td>
                        <td>{{ $produk->Stok }}</td>
                        <td>
                            <form action="{{ route('penjualan.add_to_cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->ProdukID }}">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $produk->Stok }}" class="form-control">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-sm btn-success">Tambah ke Keranjang</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

        </div>

        <div class="col-6">
            <!-- Tabel Keranjang Belanja -->
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Keranjang Belanja</h2>
                </div>
                <div class="card-body">
                    <table class="table table-flush table-hover">
                        <!-- Header Tabel -->
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- Data Keranjang -->
                        <tbody>
                            @foreach ($keranjang as $item)
                                <tr>
                                    <td>{{ $item->produk->NamaProduk }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp. {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('penjualan.remove_from_cart', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!-- Total Harga -->
                        <tfoot>
                            <tr>
                            <th colspan="2">Total Harga:</th>
                            <th>Rp. {{ number_format($totalHarga, 2, ',', '.') }}</th>
                            <th></th>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- Form Bayar -->
                    <form action="{{ route('penjualan.bayar') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="bayar">Bayar:</label>
                            <input type="number" name="bayar" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kembalian">Kembalian:</label>
                            <input type="text" name="kembalian" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pelangganModal">Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pelanggan -->
    <div class="modal fade" id="pelangganModal" tabindex="-1" role="dialog" aria-labelledby="pelangganModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pelangganModalLabel">Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Pelanggan -->
                    <form action="{{ route('penjualan.simpan_pelanggan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="NamaPelanggan">Nama Pelanggan:</label>
                            <input type="text" name="NamaPelanggan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Alamat">Alamat:</label>
                            <input type="text" name="Alamat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="NomorTelepon">Nomor Telepon:</label>
                            <input type="text" name="NomorTelepon" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


