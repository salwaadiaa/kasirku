@extends('layouts.app')
@section('title', 'Edit Produk')

@section('title-header', 'Edit Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Data Produk</a></li>
    <li class="breadcrumb-item active">Edit Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Edit Data Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->ProdukID) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="NamaProduk">Nama Produk</label>
                                    <input type="text" class="form-control @error('NamaProduk') is-invalid @enderror" id="NamaProduk"
                                        placeholder="Nama Produk" value="{{ $produk->NamaProduk }}" name="NamaProduk">

                                    @error('NamaProduk')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="Harga">Harga</label>
                                    <input type="text" class="form-control @error('Harga') is-invalid @enderror" id="Harga"
                                        placeholder="Harga" value="{{ $produk->Harga }}" name="Harga">

                                    @error('Harga')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="Stok">Stok</label>
                                    <input type="text" class="form-control @error('Stok') is-invalid @enderror" id="Stok"
                                        placeholder="Stok" value="{{ $produk->Stok }}" name="Stok">

                                    @error('Stok')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" placeholder="Gambar"
                                        name="gambar">

                                    @error('gambar')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-sm btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
