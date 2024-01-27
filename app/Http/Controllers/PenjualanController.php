<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $keranjang = Keranjang::all();
        $totalHarga = Keranjang::sum('subtotal');

        return view('dashboard.penjualan.index', compact('produks', 'keranjang', 'totalHarga'));
    }

    public function penjualan()
    {
        $penjualans = Penjualan::with(['pelanggan', 'produk'])->get();
        return view('dashboard.penjualan.dataIndex', compact('penjualans'));
    }

    public function addToCart(Request $request)
{
    // Validasi request
    $request->validate([
        'produk_id' => 'required|exists:produks,ProdukID',
        'quantity' => 'required|integer|min:1',
    ]);

    // Ambil data produk
    $produk = Produk::find($request->produk_id);

    // Cek stok produk
    if ($produk->Stok >= $request->quantity) {
        // Kurangi stok produk
        $produk->decrement('Stok', $request->quantity);

        // Tambahkan produk ke keranjang
        Keranjang::create([
            'produk_id' => $produk->ProdukID,
            'quantity' => $request->quantity,
            'subtotal' => $produk->Harga * $request->quantity,
        ]);
    }

    return redirect()->route('penjualan.index');
}


    public function removeFromCart($id)
    {
        // Ambil data item keranjang
        $item = Keranjang::findOrFail($id);

        // Tambahkan stok produk yang dihapus dari keranjang
        $produk = Produk::find($item->produk_id);
        $produk->increment('Stok', $item->quantity);

        // Hapus item dari keranjang
        $item->delete();

        return redirect()->route('penjualan.index');
    }

    public function bayar(Request $request)
    {
        // Validasi request
        $request->validate([
            'bayar' => 'required|numeric|min:' . Keranjang::sum('subtotal'),
        ]);

        // Hitung kembalian
        $totalHarga = Keranjang::sum('subtotal');
        $kembalian = $request->bayar - $totalHarga;

        // Tampilkan kembalian pada halaman penjualan
        return view('penjualan', compact('kembalian'));
    }

        public function simpanPelanggan(Request $request)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string|max:255',
            'NomorTelepon' => 'required|string|max:15',
        ]);

        // Create a Pelanggan record
        $pelanggan = Pelanggan::create([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
        ]);

        // Create a Penjualan record
        $penjualan = $pelanggan->penjualans()->create([
            'TanggalPenjualan' => now(),
            'Harga' => Keranjang::sum('subtotal'),
            'quantity' => 0, // You may need to set the correct quantity when you have it
            'status' => 'pending', // Set the status accordingly
            'ProdukID' => 1, // Replace with a valid ProdukID from the produks table
        ]);

        // Create DetailPenjualan records
        $keranjangItems = Keranjang::all();
        foreach ($keranjangItems as $item) {
            DetailPenjualan::create([
                'PenjualanID' => $penjualan->PenjualanID,
                'ProdukID' => $item->produk_id,
                'JumlahProduk' => $item->quantity,
                'Subtotal' => $item->subtotal,
            ]);
        }

        // Clear the Keranjang
        Keranjang::truncate();

        return redirect()->route('penjualan.index');
    }
    public function updateQuantity(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|numeric|min:1',
    ]);

    $keranjangItem = Keranjang::findOrFail($id);

    // Calculate the difference in quantity
    $quantityDifference = $request->quantity - $keranjangItem->quantity;

    // Update the quantity and subtotal in the cart
    $keranjangItem->update([
        'quantity' => $request->quantity,
        'subtotal' => $keranjangItem->produk->Harga * $request->quantity,
    ]);

    // Update the stock in the product
    $keranjangItem->produk->decrement('Stok', $quantityDifference);

    return redirect()->route('penjualan.index');
}

public function filterPenjualan(Request $request)
{
    $tanggal = $request->input('tanggal');

    // Jika tanggal tidak kosong, filter berdasarkan tanggal
    $penjualans = $tanggal
        ? Penjualan::with(['pelanggan', 'produk'])->whereDate('TanggalPenjualan', $tanggal)->get()
        : Penjualan::with(['pelanggan', 'produk'])->get();

    return view('dashboard.penjualan.dataIndex', compact('penjualans'));
}

public function exportPDF(Request $request)
{
    $tanggal = $request->input('tanggal');

    // Jika tanggal tidak kosong, filter berdasarkan tanggal
    $penjualans = $tanggal
        ? Penjualan::with(['pelanggan', 'produk'])->whereDate('TanggalPenjualan', $tanggal)->get()
        : Penjualan::with(['pelanggan', 'produk'])->get();

    $pdf = PDF::loadView('dashboard.penjualan.exportPDF', compact('penjualans'));

    return $pdf->download('laporan_penjualan.pdf');
}



    
}
