<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'total_belanja',
        'pembayaran',
        'shift'
    ];

    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }

    public function segmentResult()
    {
        return $this->hasOne(HasilSegmentasi::class);
    }
}
