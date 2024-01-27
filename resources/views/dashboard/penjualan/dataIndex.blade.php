@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('title-header', 'Data Penjualan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Penjualan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Penjualan</h2>
                    <!-- Form Filter Tanggal -->
                    <form action="{{ route('penjualan.filter') }}" method="GET" class="form-inline float-right">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="tanggal" class="mr-2">Filter Tanggal:</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </form>
                    @if(auth()->user()->role == 'admin')
                    <a href="{{ route('penjualan.exportPDF', ['tanggal' => Request::get('tanggal')]) }}" class="btn btn-danger mb-2 ml-2">Export PDF</a>
                    @endif
                </div>
                <!-- Tabel Penjualan -->
                <div class="card-body">
                    <table class="table table-flush table-hover">
                        <!-- Header Tabel -->
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Penjualan</th>
                                <th>Harga</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                            </tr>
                        </thead>
                        <!-- Data Penjualan -->
                        <tbody>
                            @forelse ($penjualans as $penjualan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $penjualan->TanggalPenjualan }}</td>
                                    <td>Rp. {{ number_format($penjualan->Harga, 2, ',', '.') }}</td>
                                    <td>{{ $penjualan->pelanggan->NamaPelanggan }}</td>
                                    <td>{{ $penjualan->produk->NamaProduk }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
