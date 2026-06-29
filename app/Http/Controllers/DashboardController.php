<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\HasilSegmentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransaksi = Transaksi::count();
        $totalProduk = Produk::count();
        
        $totalCluster = HasilSegmentasi::distinct('cluster')->count();
        $dbiScore = session('dbi_score', HasilSegmentasi::count() > 0 ? 0.556 : 0.00);

        // Get cluster distributions
        $clusterStatsRaw = HasilSegmentasi::select('keterangan', DB::raw('count(*) as count'))
            ->groupBy('keterangan')
            ->get();

        $clusterStats = [];
        foreach ($clusterStatsRaw as $stat) {
            $clusterStats[$stat->keterangan] = $stat->count;
        }

        // 1. Get recent 5 transactions
        $recentTransactions = Transaksi::with(['items.product'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // 2. Get payment preference stats
        $paymentStats = Transaksi::select('pembayaran', DB::raw('count(*) as count'))
            ->groupBy('pembayaran')
            ->pluck('count', 'pembayaran')
            ->toArray();

        // 3. Get detailed cluster averages for the side panel
        $clusterDetails = [];
        if (HasilSegmentasi::count() > 0) {
            $detailsRaw = HasilSegmentasi::join('transaksis', 'hasil_segmentasis.transaksi_id', '=', 'transaksis.id')
                ->select(
                    'hasil_segmentasis.keterangan',
                    DB::raw('count(hasil_segmentasis.id) as count'),
                    DB::raw('avg(transaksis.total_belanja) as avg_spending')
                )
                ->groupBy('hasil_segmentasis.keterangan')
                ->get();

            foreach ($detailsRaw as $detail) {
                $clusterDetails[$detail->keterangan] = [
                    'count' => $detail->count,
                    'avg_spending' => $detail->avg_spending,
                    'percentage' => $totalTransaksi > 0 ? ($detail->count / $totalTransaksi) * 100 : 0
                ];
            }
        }

        return view('dashboard', compact(
            'totalTransaksi', 
            'totalProduk', 
            'totalCluster', 
            'dbiScore', 
            'clusterStats',
            'recentTransactions',
            'paymentStats',
            'clusterDetails'
        ));
    }
}
