@extends('layouts.app')
@section('title', 'Detail Penjualan')

@section('title-header', 'Detail Penjualan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Detail Penjualan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Detail Penjualan</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Penjualan</th>
                                    <th>Produk</th>
                                    <th>Jumlah Produk</th>
                                    <th>Subtotal</th>
                                    @if(auth()->user()->role == 'petugas')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailPenjualans as $detailPenjualan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($detailPenjualan->penjualan)->TanggalPenjualan }}</td>
                                        <td>{{ optional($detailPenjualan->produk)->NamaProduk }}</td>
                                        <td>{{ $detailPenjualan->JumlahProduk }}</td>
                                        <td>{{ $detailPenjualan->Subtotal }}</td>
                                        @if(auth()->user()->role == 'petugas')
                                        <td>
                                        <a href="{{ route('detail_penjualan.pdf', ['DetailID' => $detailPenjualan->DetailID]) }}" class="btn btn-sm btn-danger">PDF</a>

                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
