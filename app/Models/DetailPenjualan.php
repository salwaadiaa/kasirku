<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualans'; // Sesuaikan dengan nama tabel yang Anda gunakan

    protected $primaryKey = 'DetailID'; // Nama kolom yang menjadi primary key

    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'JumlahProduk',
        'Subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID', 'ProdukID');
    }
}
