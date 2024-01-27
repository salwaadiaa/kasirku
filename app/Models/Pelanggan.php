<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $primaryKey = 'PelangganID'; 

    protected $fillable = [
        'NamaPelanggan',
        'Alamat',
        'NomorTelepon',
    ];

    public function penjualans()
{
    return $this->hasMany(Penjualan::class, 'PelangganID');
}
}
