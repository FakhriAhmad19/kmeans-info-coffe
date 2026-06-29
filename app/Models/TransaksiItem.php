<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'qty',
        'harga_satuan'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
