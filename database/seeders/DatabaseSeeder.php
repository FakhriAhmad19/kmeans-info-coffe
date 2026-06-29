<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin Info Coffee',
                'email' => 'admin@infocoffee.com',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Parse and seed transactions from real_data.txt
        $filePath = database_path('seeders/real_data.txt');
        if (!file_exists($filePath)) {
            $filePath = base_path('database/seeders/real_data.txt');
        }
        
        $lines = file($filePath);
        // Skip header
        array_shift($lines);

        $transactions = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            $row = explode("\t", $line);
            if (count($row) < 10) continue;

            $kode_transaksi = trim($row[0]);
            
            // Parse Date
            $dateStr = trim($row[1]);
            if (strpos($dateStr, '/') !== false) {
                $parts = explode('/', $dateStr);
                if (count($parts) == 3) {
                    $year = trim($parts[2]);
                    if (strlen($year) == 2) {
                        $year = '20' . $year;
                    }
                    $month = str_pad(trim($parts[1]), 2, '0', STR_PAD_LEFT);
                    $day = str_pad(trim($parts[0]), 2, '0', STR_PAD_LEFT);
                    $tanggal = "$year-$month-$day";
                } else {
                    $tanggal = $dateStr;
                }
            } else {
                $tanggal = $dateStr;
            }

            $nama_produk = trim($row[3]);
            $kategori = trim($row[4]);
            $qty = intval(trim($row[5]));

            $priceStr = str_replace(['Rp', '.', ',00'], '', trim($row[6]));
            $harga_satuan = intval(trim($priceStr));

            $totalStr = str_replace(['Rp', '.', ',00'], '', trim($row[7]));
            $total_belanja = intval(trim($totalStr));

            $pembayaran = trim($row[8]);
            $shift = trim($row[9]);

            // Find or create product
            $product = Produk::where('nama_produk', $nama_produk)->first();
            if (!$product) {
                $count = Produk::count() + 1;
                $kode_produk = 'PRD' . str_pad($count, 3, '0', STR_PAD_LEFT);
                $product = Produk::create([
                    'kode_produk' => $kode_produk,
                    'nama_produk' => $nama_produk,
                    'kategori' => $kategori,
                    'harga' => $harga_satuan
                ]);
            }

            // Create Transaction
            $trans = Transaksi::create([
                'kode_transaksi' => $kode_transaksi,
                'tanggal' => $tanggal,
                'total_belanja' => $total_belanja,
                'pembayaran' => $pembayaran,
                'shift' => $shift
            ]);

            // Create Transaction Item
            TransaksiItem::create([
                'transaksi_id' => $trans->id,
                'produk_id' => $product->id,
                'qty' => $qty,
                'harga_satuan' => $harga_satuan
            ]);
        }
    }
}
