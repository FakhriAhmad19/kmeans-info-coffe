@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Hasil Segmentasi K-Means</h2>
            <p class="text-muted mb-0">Visualisasi hasil pengelompokan transaksi Info Coffee menggunakan K-Means.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('clustering.index') }}" class="btn btn-coffee-secondary rounded-3 px-4 py-2">
                <i class="bi bi-gear-fill me-1"></i> Ulangi Proses
            </a>
            <a href="{{ route('laporan.pdf') }}" class="btn btn-coffee rounded-3 px-4 py-2 shadow-sm">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Unduh PDF
            </a>
        </div>
    </div>

    <!-- Metrics Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: #D4AF37;">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Evaluasi DBI Score</div>
                <div class="h2 fw-bold text-dark mb-1">{{ number_format($results['dbi'], 3) }}</div>
                <span class="fs-7 badge {{ $results['dbi'] <= 1.0 ? 'bg-success' : 'bg-danger' }} d-inline-block w-auto">
                    {{ $results['dbi'] <= 1.0 ? 'Kualitas Baik' : 'Kualitas Kurang Baik' }}
                </span>
                <i class="bi bi-activity metric-icon"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: var(--coffee-espresso);">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Total Data Tersegmentasi</div>
                <div class="h2 fw-bold text-dark mb-1">{{ count($results['data']) }} Transaksi</div>
                <span class="fs-7 text-muted fw-semibold"><i class="bi bi-check-circle-fill text-success"></i> Konvergen</span>
                <i class="bi bi-database-check metric-icon"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: var(--coffee-mocha);">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Jumlah Perulangan (Iterasi)</div>
                <div class="h2 fw-bold text-dark mb-1">{{ $results['iterations'] }} Iterasi</div>
                <span class="fs-7 text-muted fw-semibold"><i class="bi bi-clock-history"></i> K-Means Loop Selesai</span>
                <i class="bi bi-arrow-repeat metric-icon"></i>
            </div>
        </div>
    </div>

    <!-- Visualizations & Centroid -->
    <div class="row g-4 mb-4">
        <!-- Distribution Chart -->
        <div class="col-md-6">
            <div class="card card-custom shadow-sm h-100 bg-white">
                <div class="card-header-custom"><i class="bi bi-pie-chart-fill me-2"></i> Proporsi Anggota Cluster</div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center">
                    <div style="height: 230px; width: 100%; position: relative;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Centroid Averages Table -->
        <div class="col-md-6">
            <div class="card card-custom shadow-sm h-100 bg-white">
                <div class="card-header-custom"><i class="bi bi-bullseye me-2"></i> Rata-rata Nilai Centroid Akhir</div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle fs-7 mb-0">
                            <thead>
                                <tr class="text-secondary" style="border-bottom: 2px solid #E0D4C3;">
                                    <th class="text-start pb-2">Cluster / Segmen</th>
                                    <th class="text-end pb-2">Rata Item (Variasi)</th>
                                    <th class="text-end pb-2">Rata Qty (Item)</th>
                                    <th class="text-end pb-2">Rata Belanja (Nominal)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['centroids'] as $cIndex => $centroid)
                                    <tr style="border-bottom: 1px solid #F3EDE4;">
                                        <td class="text-start py-3">
                                            @if(strpos($results['cluster_labels'][$cIndex], 'Tinggi') !== false)
                                                <span class="badge-coffee-high d-inline-block">Tinggi</span>
                                            @elseif(strpos($results['cluster_labels'][$cIndex], 'Sedang') !== false)
                                                <span class="badge-coffee-medium d-inline-block">Sedang</span>
                                            @else
                                                <span class="badge-coffee-low d-inline-block">Rendah</span>
                                            @endif
                                        </td>
                                        <td class="text-end py-3">{{ number_format($centroid['frekuensi'], 2) }}</td>
                                        <td class="text-end py-3">{{ number_format($centroid['qty'], 2) }}</td>
                                        <td class="text-end py-3 fw-bold text-dark">Rp {{ number_format($centroid['total_belanja'], 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top pt-3 mt-3 text-muted fs-7">
                        <i class="bi bi-info-circle"></i> Nilai rata-rata centroid akhir menunjukkan pusat nilai tengah belanja untuk mengelompokkan nota transaksi secara akurat.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Segmented Data Table Card -->
    <div class="card card-custom shadow-sm border-0 bg-white">
        <div class="card-header-custom"><i class="bi bi-table me-2"></i> Detail Hasil Pengelompokan Data</div>
        <div class="card-body p-0">
            <div class="table-responsive p-3" style="max-height: 520px; overflow-y: auto;">
                <table class="table table-custom align-middle mb-0 fs-7">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th>ID Transaksi</th>
                            <th>Rata Item</th>
                            <th>Total Qty</th>
                            <th>Total Belanja</th>
                            <th>Keterangan Cluster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results['data'] as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="fw-bold text-secondary">{{ $row['kode_transaksi'] }}</span></td>
                                <td>{{ $row['frekuensi'] }}</td>
                                <td>{{ $row['total_qty'] }}</td>
                                <td>Rp {{ number_format($row['total_belanja']) }}</td>
                                <td>
                                    @if(strpos($row['keterangan'], 'Tinggi') !== false)
                                        <span class="badge-coffee-high">Tinggi</span>
                                    @elseif(strpos($row['keterangan'], 'Sedang') !== false)
                                        <span class="badge-coffee-medium">Sedang</span>
                                    @else
                                        <span class="badge-coffee-low">Rendah</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('pieChart').getContext('2d');
        
        // Group data to count elements per label
        const counts = {};
        const labelsMap = {!! json_encode($results['cluster_labels']) !!};
        
        // Initialize counts
        Object.keys(labelsMap).forEach(key => {
            counts[labelsMap[key]] = 0;
        });

        const rawData = {!! json_encode($results['data']) !!};
        rawData.forEach(item => {
            counts[item.keterangan] = (counts[item.keterangan] || 0) + 1;
        });

        const labels = Object.keys(counts);
        const dataValues = Object.values(counts);

        // Coffee themed colors
        const bgColors = labels.map(label => {
            if (label.includes('Tinggi')) return '#4E342E'; // Espresso/Mocha
            if (label.includes('Sedang')) return '#8D6E63'; // Caramel/Coffee
            return '#D7CCC8'; // Latte/Cream
        });

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#3E2723',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
