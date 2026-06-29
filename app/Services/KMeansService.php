<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Models\HasilSegmentasi;
use Illuminate\Support\Facades\DB;

class KMeansService
{
    /**
     * Run K-Means Clustering on Transaction Data
     *
     * @param int $k Number of clusters
     * @return array
     */
    public function runClustering(int $k = 3): array
    {
        // 1. Fetch aggregated transaction data
        $transactions = DB::table('transaksis as t')
            ->join('transaksi_items as ti', 't.id', '=', 'ti.transaksi_id')
            ->select(
                't.id as transaksi_id',
                't.kode_transaksi',
                DB::raw('COUNT(ti.id) as frekuensi'),
                DB::raw('SUM(ti.qty) as total_qty'),
                't.total_belanja'
            )
            ->groupBy('t.id', 't.kode_transaksi', 't.total_belanja')
            ->get()
            ->toArray();

        if (count($transactions) < $k) {
            throw new \Exception("Jumlah data transaksi kurang dari jumlah cluster (K = $k).");
        }

        // 2. Determine Min-Max values dynamically
        $minQty = min(array_column($transactions, 'total_qty'));
        $maxQty = max(array_column($transactions, 'total_qty'));
        $minBelanja = min(array_column($transactions, 'total_belanja'));
        $maxBelanja = max(array_column($transactions, 'total_belanja'));

        // 3. Normalize data
        $normalizedData = [];
        foreach ($transactions as $t) {
            $normQty = ($maxQty - $minQty) == 0 ? 0 : ($t->total_qty - $minQty) / ($maxQty - $minQty);
            $normBelanja = ($maxBelanja - $minBelanja) == 0 ? 0 : ($t->total_belanja - $minBelanja) / ($maxBelanja - $minBelanja);

            $normalizedData[] = [
                'transaksi_id' => $t->transaksi_id,
                'kode_transaksi' => $t->kode_transaksi,
                'raw' => [
                    'frekuensi' => $t->frekuensi,
                    'qty' => $t->total_qty,
                    'total_belanja' => $t->total_belanja,
                ],
                'normalized' => [
                    'qty' => $normQty,
                    'total_belanja' => $normBelanja,
                ],
                'cluster' => -1,
                'distances' => []
            ];
        }

        // 4. Initialize Centroids
        $centroids = [];
        if ($k == 3) {
            // Initial Centroids from Proposal (Tahu Walik: Qty=1, Total=20000; Sanger Dingin: Qty=2, Total=60000; Jeniper Dingin: Qty=2, Total=90000)
            $centroids[0] = [
                'qty' => ($maxQty - $minQty) == 0 ? 0 : (1 - $minQty) / ($maxQty - $minQty),
                'total_belanja' => ($maxBelanja - $minBelanja) == 0 ? 0 : (20000 - $minBelanja) / ($maxBelanja - $minBelanja)
            ];
            $centroids[1] = [
                'qty' => ($maxQty - $minQty) == 0 ? 0 : (2 - $minQty) / ($maxQty - $minQty),
                'total_belanja' => ($maxBelanja - $minBelanja) == 0 ? 0 : (60000 - $minBelanja) / ($maxBelanja - $minBelanja)
            ];
            $centroids[2] = [
                'qty' => ($maxQty - $minQty) == 0 ? 0 : (2 - $minQty) / ($maxQty - $minQty),
                'total_belanja' => ($maxBelanja - $minBelanja) == 0 ? 0 : (116000 - $minBelanja) / ($maxBelanja - $minBelanja)
            ];
        } else {
            $step = floor(count($normalizedData) / $k);
            for ($i = 0; $i < $k; $i++) {
                $index = $i * $step;
                $centroids[$i] = $normalizedData[$index]['normalized'];
            }
        }

        $converged = false;
        $maxIterations = 100;
        $iteration = 0;

        // 5. K-Means Main Loop
        while (!$converged && $iteration < $maxIterations) {
            $iteration++;
            $oldAssignments = array_column($normalizedData, 'cluster');

            // Step A: Assign points to nearest centroid
            foreach ($normalizedData as &$point) {
                $minDistance = INF;
                $closestCluster = -1;

                foreach ($centroids as $cIndex => $centroid) {
                    $dist = $this->calculateEuclideanDistance($point['normalized'], $centroid);
                    $point['distances'][$cIndex] = $dist;

                    if ($dist < $minDistance) {
                        $minDistance = $dist;
                        $closestCluster = $cIndex;
                    }
                }
                $point['cluster'] = $closestCluster;
            }
            unset($point); // break reference

            // Step B: Update centroids
            $newCentroids = [];
            for ($cIndex = 0; $cIndex < $k; $cIndex++) {
                $clusterPoints = array_filter($normalizedData, function ($p) use ($cIndex) {
                    return $p['cluster'] == $cIndex;
                });

                if (count($clusterPoints) > 0) {
                    $sumQty = array_sum(array_column(array_column($clusterPoints, 'normalized'), 'qty'));
                    $sumBelanja = array_sum(array_column(array_column($clusterPoints, 'normalized'), 'total_belanja'));
                    $count = count($clusterPoints);

                    $newCentroids[$cIndex] = [
                        'qty' => $sumQty / $count,
                        'total_belanja' => $sumBelanja / $count,
                    ];
                } else {
                    // fallback to old centroid if cluster becomes empty
                    $newCentroids[$cIndex] = $centroids[$cIndex];
                }
            }

            // Step C: Check convergence
            $newAssignments = array_column($normalizedData, 'cluster');
            if ($oldAssignments === $newAssignments) {
                $converged = true;
            } else {
                $centroids = $newCentroids;
            }
        }

        // 6. Calculate Davies-Bouldin Index (DBI)
        $dbiScore = $this->calculateDBI($normalizedData, $centroids, $k);

        // 7. Label Clusters dynamically based on Average Spending (total_belanja)
        // High spending = 'Tinggi', Medium = 'Sedang', Low = 'Rendah'
        $clusterSpending = [];
        for ($cIndex = 0; $cIndex < $k; $cIndex++) {
            $clusterPoints = array_filter($normalizedData, function ($p) use ($cIndex) {
                return $p['cluster'] == $cIndex;
            });
            $avgSpending = count($clusterPoints) == 0 ? 0 : array_sum(array_column(array_column($clusterPoints, 'raw'), 'total_belanja')) / count($clusterPoints);
            $clusterSpending[$cIndex] = $avgSpending;
        }

        // Sort descending by average spending
        arsort($clusterSpending);
        $ranks = array_keys($clusterSpending); // ranks[0] is highest spending, ranks[k-1] is lowest

        // Mapping labels
        $clusterLabels = [];
        if ($k == 3) {
            $clusterLabels[$ranks[0]] = 'Pola Pembelian Tinggi';
            $clusterLabels[$ranks[1]] = 'Pola Pembelian Sedang';
            $clusterLabels[$ranks[2]] = 'Pola Pembelian Rendah';
        } else {
            // General labeling for other K values
            for ($i = 0; $i < $k; $i++) {
                $clusterLabels[$ranks[$i]] = 'Cluster ' . ($i + 1);
            }
        }

        // 8. Save results to HasilSegmentasi table
        HasilSegmentasi::truncate(); // clear previous results
        foreach ($normalizedData as $point) {
            HasilSegmentasi::create([
                'transaksi_id' => $point['transaksi_id'],
                'cluster' => $point['cluster'],
                'keterangan' => $clusterLabels[$point['cluster']]
            ]);
        }

        // Map final output variables
        $labeledClusters = [];
        foreach ($normalizedData as $point) {
            $labeledClusters[] = [
                'transaksi_id' => $point['transaksi_id'],
                'kode_transaksi' => $point['kode_transaksi'],
                'frekuensi' => $point['raw']['frekuensi'],
                'total_qty' => $point['raw']['qty'],
                'total_belanja' => $point['raw']['total_belanja'],
                'cluster' => $point['cluster'],
                'keterangan' => $clusterLabels[$point['cluster']]
            ];
        }

        return [
            'dbi' => $dbiScore,
            'k' => $k,
            'iterations' => $iteration,
            'centroids' => $centroids,
            'cluster_labels' => $clusterLabels,
            'data' => $labeledClusters
        ];
    }

    /**
     * Calculate Euclidean Distance between two normalized points
     */
    private function calculateEuclideanDistance(array $p1, array $p2): float
    {
        return sqrt(
            pow($p1['qty'] - $p2['qty'], 2) +
            pow($p1['total_belanja'] - $p2['total_belanja'], 2)
        );
    }

    /**
     * Calculate Davies-Bouldin Index (DBI)
     */
    private function calculateDBI(array $data, array $centroids, int $k): float
    {
        // A. Calculate Intra-Cluster distances (S_i)
        $s = [];
        for ($i = 0; $i < $k; $i++) {
            $clusterPoints = array_filter($data, function ($p) use ($i) {
                return $p['cluster'] == $i;
            });
            $count = count($clusterPoints);

            if ($count > 0) {
                $sumDist = 0;
                foreach ($clusterPoints as $p) {
                    $sumDist += $this->calculateEuclideanDistance($p['normalized'], $centroids[$i]);
                }
                $s[$i] = $sumDist / $count;
            } else {
                $s[$i] = 0;
            }
        }

        // B. Calculate Inter-Centroid distances (M_ij) and similarity ratios (R_ij)
        $r = [];
        for ($i = 0; $i < $k; $i++) {
            $r[$i] = [];
            for ($j = 0; $j < $k; $j++) {
                if ($i != $j) {
                    $m_ij = $this->calculateEuclideanDistance($centroids[$i], $centroids[$j]);
                    $r[$i][$j] = $m_ij == 0 ? 0 : ($s[$i] + $s[$j]) / $m_ij;
                }
            }
        }

        // C. Calculate Max R_ij for each cluster (D_i)
        $d = [];
        for ($i = 0; $i < $k; $i++) {
            $d[$i] = count($r[$i]) > 0 ? max($r[$i]) : 0;
        }

        // D. Calculate average D_i
        return array_sum($d) / $k;
    }
}
