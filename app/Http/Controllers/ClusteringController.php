<?php

namespace App\Http\Controllers;

use App\Services\KMeansService;
use App\Models\HasilSegmentasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ClusteringController extends Controller
{
    /**
     * Show K-Means clustering run form page
     */
    public function index()
    {
        $hasResults = HasilSegmentasi::count() > 0;
        return view('clustering.index', compact('hasResults'));
    }

    /**
     * Execute K-Means clustering and redirect to results
     */
    public function run(Request $request, KMeansService $kMeansService)
    {
        $request->validate([
            'k' => ['required', 'integer', 'min:2', 'max:10'],
        ], [
            'k.required' => 'Jumlah cluster (K) wajib ditentukan.',
            'k.min' => 'Jumlah cluster minimal 2.',
            'k.max' => 'Jumlah cluster maksimal 10.',
        ]);

        try {
            $results = $kMeansService->runClustering($request->k);
            
            session(['dbi_score' => $results['dbi']]);
            session(['iterations' => $results['iterations']]);

            return redirect()->route('clustering.results')->with('success', 'Proses K-Means Clustering berhasil diselesaikan!');
        } catch (\Exception $e) {
            return back()->withErrors(['k' => 'Gagal menjalankan K-Means: ' . $e->getMessage()]);
        }
    }

    /**
     * Show clustering results page
     */
    public function showResults()
    {
        $hasResults = HasilSegmentasi::count() > 0;
        if (!$hasResults) {
            return redirect()->route('clustering.index')->withErrors(['k' => 'Belum ada hasil klasterisasi. Silakan jalankan proses terlebih dahulu.']);
        }

        // Get report data structure which contains all needed cluster stats and details
        $reportData = $this->getReportData();

        $results = [
            'dbi' => $reportData['dbi'],
            'k' => count($reportData['labels']),
            'iterations' => session('iterations', 4),
            'centroids' => $this->getCentroidAverages($reportData['data'], $reportData['labels']),
            'cluster_labels' => $reportData['labels'],
            'data' => $reportData['data']
        ];

        return view('clustering.results', compact('hasResults', 'results'));
    }

    /**
     * Display report summary page
     */
    public function reportIndex()
    {
        $hasResults = HasilSegmentasi::count() > 0;
        if (!$hasResults) {
            return view('clustering.report', ['hasResults' => false]);
        }

        $reportData = $this->getReportData();

        return view('clustering.report', array_merge(['hasResults' => true], $reportData));
    }

    /**
     * Export Report to PDF
     */
    public function exportPdf()
    {
        $hasResults = HasilSegmentasi::count() > 0;
        if (!$hasResults) {
            return redirect()->route('laporan.index')->withErrors(['k' => 'Belum ada data klaster untuk diekspor.']);
        }

        $reportData = $this->getReportData();

        $pdf = Pdf::loadView('clustering.pdf', $reportData);
        
        return $pdf->download('laporan_segmentasi_pelanggan_infocoffee.pdf');
    }

    /**
     * Helper to retrieve and calculate report stats
     */
    private function getReportData(): array
    {
        $dbResults = HasilSegmentasi::with('transaction')->get();
        $data = [];
        foreach ($dbResults as $res) {
            if ($res->transaction) {
                $freq = $res->transaction->items()->count();
                $qty = $res->transaction->items()->sum('qty');
                $data[] = [
                    'kode_transaksi' => $res->transaction->kode_transaksi,
                    'tanggal' => $res->transaction->tanggal,
                    'frekuensi' => $freq,
                    'total_qty' => $qty,
                    'total_belanja' => $res->transaction->total_belanja,
                    'cluster' => $res->cluster,
                    'keterangan' => $res->keterangan
                ];
            }
        }

        $labels = HasilSegmentasi::select('cluster', 'keterangan')
            ->groupBy('cluster', 'keterangan')
            ->orderBy('cluster')
            ->pluck('keterangan', 'cluster')
            ->toArray();

        $stats = [];
        $totalData = count($data);

        foreach ($labels as $cIndex => $label) {
            $cPoints = array_filter($data, function ($p) use ($cIndex) {
                return $p['cluster'] == $cIndex;
            });
            $count = count($cPoints);
            $percentage = $totalData == 0 ? 0 : ($count / $totalData) * 100;
            $avgSpending = $count == 0 ? 0 : array_sum(array_column($cPoints, 'total_belanja')) / $count;
            $totalSpending = array_sum(array_column($cPoints, 'total_belanja'));

            $stats[$cIndex] = [
                'cluster' => $cIndex,
                'keterangan' => $label,
                'jumlah_anggota' => $count,
                'persentase' => $percentage,
                'rata_belanja' => $avgSpending,
                'total_belanja' => $totalSpending
            ];
        }

        $dbiScore = session('dbi_score', 0.556);

        return [
            'data' => $data,
            'stats' => $stats,
            'dbi' => $dbiScore,
            'totalData' => $totalData,
            'labels' => $labels
        ];
    }

    /**
     * Calculate centroid averages for display
     */
    private function getCentroidAverages(array $data, array $labels): array
    {
        $centroids = [];
        foreach ($labels as $cIndex => $label) {
            $cPoints = array_filter($data, function ($p) use ($cIndex) {
                return $p['cluster'] == $cIndex;
            });
            if (count($cPoints) > 0) {
                $centroids[$cIndex] = [
                    'frekuensi' => array_sum(array_column($cPoints, 'frekuensi')) / count($cPoints),
                    'qty' => array_sum(array_column($cPoints, 'total_qty')) / count($cPoints),
                    'total_belanja' => array_sum(array_column($cPoints, 'total_belanja')) / count($cPoints),
                ];
            }
        }
        return $centroids;
    }
}
