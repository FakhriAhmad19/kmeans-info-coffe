@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Laporan Hasil Segmentasi K-Means</h2>
            <p class="text-muted mb-0">Analisis dan ekspor laporan segmentasi pelanggan Info Coffee berdasarkan nilai transaksi.</p>
        </div>
        @if($hasResults)
            <a href="{{ route('laporan.pdf') }}" class="btn btn-coffee rounded-3 px-4 py-2 shadow-sm">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Unduh Laporan (PDF)
            </a>
        @endif
    </div>

    @if($hasResults)
        <div class="row g-4 mb-4">
            <!-- Summary Table Card -->
            <div class="col-md-7">
                <div class="card card-custom shadow-sm h-100 bg-white">
                    <div class="card-header-custom"><i class="bi bi-table me-2"></i> Ringkasan Hasil Segmentasi</div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center fs-7">
                                <thead class="table-light">
                                    <tr>
                                        <th>Cluster</th>
                                        <th>Jumlah Anggota</th>
                                        <th>Persentase (%)</th>
                                        <th>Rata-rata Belanja</th>
                                        <th>Total Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $grandTotalMembers = 0;
                                        $grandTotalSpend = 0;
                                    @endphp
                                    @foreach($stats as $row)
                                        @php
                                            $grandTotalMembers += $row['jumlah_anggota'];
                                            $grandTotalSpend += $row['total_belanja'];
                                        @endphp
                                        <tr>
                                            <td>
                                                @if(strpos($row['keterangan'], 'Tinggi') !== false)
                                                    <span class="badge-coffee-high">Tinggi</span>
                                                @elseif(strpos($row['keterangan'], 'Sedang') !== false)
                                                    <span class="badge-coffee-medium">Sedang</span>
                                                @else
                                                    <span class="badge-coffee-low">Rendah</span>
                                                @endif
                                            </td>
                                            <td><strong>{{ $row['jumlah_anggota'] }}</strong></td>
                                            <td>{{ number_format($row['persentase'], 1) }}%</td>
                                            <td>Rp {{ number_format($row['rata_belanja']) }}</td>
                                            <td><strong>Rp {{ number_format($row['total_belanja']) }}</strong></td>
                                        </tr>
                                    @endforeach
                                    <tr class="table-secondary fw-bold">
                                        <td>TOTAL</td>
                                        <td>{{ $grandTotalMembers }}</td>
                                        <td>100.0%</td>
                                        <td>Rp {{ number_format($grandTotalMembers > 0 ? $grandTotalSpend / $grandTotalMembers : 0) }}</td>
                                        <td>Rp {{ number_format($grandTotalSpend) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribution Chart Card -->
            <div class="col-md-5">
                <div class="card card-custom shadow-sm h-100 bg-white">
                    <div class="card-header-custom"><i class="bi bi-pie-chart-fill me-2"></i> Proporsi Anggota Cluster</div>
                    <div class="card-body p-4 d-flex align-items-center justify-content-center">
                        <div style="height: 220px; width: 100%; position: relative;">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed List Table Card -->
        <div class="card card-custom shadow-sm border-0 bg-white">
            <div class="card-header-custom"><i class="bi bi-list-stars me-2"></i> Rincian Data Transaksi Tersegmentasi</div>
            <div class="card-body p-0">
                <div class="table-responsive p-3" style="max-height: 520px; overflow-y: auto;">
                    <table class="table table-custom align-middle mb-0 fs-7">
                        <thead>
                            <tr>
                                <th width="80">No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Rata Item</th>
                                <th>Total Qty</th>
                                <th>Total Belanja</th>
                                <th>Keterangan Cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="fw-bold text-secondary">{{ $row['kode_transaksi'] }}</span></td>
                                    <td>{{ date('d/m/Y', strtotime($row['tanggal'])) }}</td>
                                    <td>{{ $row['frekuensi'] }}</td>
                                    <td>{{ $row['total_qty'] }}</td>
                                    <td><strong>Rp {{ number_format($row['total_belanja']) }}</strong></td>
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
    @else
        <div class="card card-custom shadow-sm py-5 text-center bg-white">
            <div class="card-body">
                <i class="bi bi-file-earmark-bar-graph fs-1 d-block mb-3 text-secondary"></i>
                <h4>Laporan Belum Tersedia</h4>
                <p class="text-muted mb-4">Silakan jalankan proses clustering K-Means di halaman proses terlebih dahulu untuk menyusun data laporan.</p>
                <a href="{{ route('clustering.index') }}" class="btn btn-coffee rounded-3 px-4 py-2"><i class="bi bi-gear-fill me-1"></i> Mulai Clustering</a>
            </div>
        </div>
    @endif
</div>

@if($hasResults)
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('pieChart').getContext('2d');
        
        const stats = {!! json_encode($stats) !!};
        const labels = Object.values(stats).map(s => s.keterangan);
        const counts = Object.values(stats).map(s => s.jumlah_anggota);

        // Coffee colors matching categories
        const bgColors = labels.map(label => {
            if (label.includes('Tinggi')) return '#4E342E'; // Mocha
            if (label.includes('Sedang')) return '#8D6E63'; // Caramel
            return '#D7CCC8'; // Latte
        });

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
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
                        position: 'bottom',
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
@endif
@endsection
