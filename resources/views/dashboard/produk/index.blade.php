@extends('layouts.app')
@section('title', 'Produk')

@section('title-header', 'Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Produk</li>
@endsection

@section('action_btn')
    <a href="{{ route('produk.create') }}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Produk</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->NamaProduk }}</td>
                                        <td>{{ $produk->Harga }}</td>
                                        <td>{{ $produk->Stok }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('produk.edit', $produk->ProdukID) }}" class="btn btn-sm btn-warning mx-1"><i class="fas fa-pencil-alt"></i></a>
                                            <button onclick="deleteForm('{{ $produk->ProdukID }}')" class="btn btn-sm btn-danger mx-1"><i class="fas fa-trash"></i></button>
                                            <form id="delete-form-{{ $produk->ProdukID }}" action="{{ route('produk.destroy', $produk->ProdukID) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6">
                                        {{ $produks->links() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteForm(id){
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit();
                }
            }) 
        }
    </script>
@endsection
