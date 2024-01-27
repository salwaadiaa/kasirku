<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualans'; // Sesuaikan dengan nama tabel yang Anda gunakan

    protected $primaryKey = 'PenjualanID'; // Nama kolom yang menjadi primary key

    protected $fillable = [
        'TanggalPenjualan',
        'Harga',
        'PelangganID',
        'ProdukID',
        'quantity',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID');
        // Metode ini mendefinisikan relasi "belongs to" antara Penjualan dan Pelanggan
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID', 'ProdukID');
    }
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
