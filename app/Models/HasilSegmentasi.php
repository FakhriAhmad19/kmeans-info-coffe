<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSegmentasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_segmentasis';

    protected $fillable = [
        'transaksi_id',
        'cluster',
        'keterangan'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
