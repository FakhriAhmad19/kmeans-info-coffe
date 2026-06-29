@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Coffee Club Analytics Dashboard</h2>
            <p class="text-muted mb-0">Overview of Info Coffee sales metrics and K-Means segmentation results.</p>
        </div>
    </div>

    <!-- Metrics Cards Row -->
    <div class="row g-3 mb-4">
        <!-- Total Transactions -->
        <div class="col-md-3">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: var(--coffee-espresso);">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Total Transaksi</div>
                <div class="h2 fw-bold text-dark mb-1">{{ number_format($totalTransaksi) }}</div>
                <div class="text-success fs-7 fw-semibold"><i class="bi bi-graph-up-arrow"></i> Aktif di Database</div>
                <i class="bi bi-receipt metric-icon"></i>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-md-3">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: var(--coffee-mocha);">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Total Produk / Menu</div>
                <div class="h2 fw-bold text-dark mb-1">{{ number_format($totalProduk) }}</div>
                <div class="text-secondary fs-7 fw-semibold"><i class="bi bi-cup-hot"></i> Makanan & Minuman</div>
                <i class="bi bi-cup-hot metric-icon"></i>
            </div>
        </div>

        <!-- Total Clusters -->
        <div class="col-md-3">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: var(--coffee-caramel);">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Total Cluster</div>
                <div class="h2 fw-bold text-dark mb-1">{{ $totalCluster > 0 ? $totalCluster . ' Segmen' : 'Belum Ada' }}</div>
                <div class="text-muted fs-7 fw-semibold"><i class="bi bi-diagram-3"></i> Tersegmentasi</div>
                <i class="bi bi-diagram-3 metric-icon"></i>
            </div>
        </div>

        <!-- DBI Score -->
        <div class="col-md-3">
            <div class="card card-custom p-3 metric-card shadow-sm h-100" style="border-left-color: #D4AF37;">
                <div class="text-muted fw-bold text-uppercase fs-7 mb-1">Nilai DBI Score</div>
                <div class="h2 fw-bold text-dark mb-1">{{ number_format($dbiScore, 3) }}</div>
                @if($totalCluster > 0)
                    <div class="fw-semibold fs-7 {{ $dbiScore <= 1.0 ? 'text-success' : 'text-danger' }}">
                        <i class="bi bi-info-circle"></i> {{ $dbiScore <= 1.0 ? 'Kualitas Baik' : 'Kurang Optimal (> 1)' }}
                    </div>
                @else
                    <div class="text-muted fs-7 fw-semibold"><i class="bi bi-info-circle"></i> Memerlukan Clustering</div>
                @endif
                <i class="bi bi-activity metric-icon"></i>
            </div>
        </div>
    </div>

    <!-- Main Section: Charts and Tables -->
    <div class="row g-4 mb-4">
        <!-- Left Panel: Chart & Recent Transactions -->
        <div class="col-md-8">
            <!-- Cluster Distribution Bar Chart -->
            <div class="card card-custom shadow-sm mb-4">
                <div class="card-header-custom"><i class="bi bi-bar-chart-fill me-2"></i> Distribusi Anggota per Cluster</div>
                <div class="card-body p-4">
                    @if(count($clusterStats) > 0)
                        <div style="height: 280px; position: relative;">
                            <canvas id="barChart"></canvas>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-database-exclamation fs-1 d-block mb-3 text-secondary"></i>
                            <h5>Data Segmentasi Belum Terbentuk</h5>
                            <p class="fs-7 mb-4">Silakan jalankan proses clustering K-Means terlebih dahulu untuk melihat grafik distribusi data.</p>
                            <a href="{{ route('clustering.index') }}" class="btn btn-coffee rounded-3 px-4 py-2"><i class="bi bi-gear-fill me-1"></i> Proses Clustering</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Transactions Table -->
            <div class="card card-custom shadow-sm border-0">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-clock-history me-2"></i> Transaksi Terkini</span>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-coffee-outline rounded-3 fs-7">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-3">
                        <table class="table table-custom align-middle mb-0 fs-7">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Daftar Menu</th>
                                    <th>Bayar</th>
                                    <th>Total Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $tx)
                                    <tr>
                                        <td><span class="fw-bold text-secondary">{{ $tx->kode_transaksi }}</span></td>
                                        <td>{{ date('d/m/Y', strtotime($tx->tanggal)) }}</td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                                {{ $tx->items->map(fn($i) => ($i->product->nama_produk ?? 'Menu') . ' (' . $i->qty . 'x)')->implode(', ') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{ $tx->pembayaran }}</span>
                                        </td>
                                        <td><strong>Rp {{ number_format($tx->total_belanja) }}</strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">Belum ada transaksi terekam.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: Payment Stats & Segment Details -->
        <div class="col-md-4">
            <!-- Payment Methods Preference -->
            <div class="card card-custom shadow-sm mb-4">
                <div class="card-header-custom"><i class="bi bi-wallet2 me-2"></i> Preferensi Metode Pembayaran</div>
                <div class="card-body p-4">
                    @php
                        $cashCount = $paymentStats['Cash'] ?? 0;
                        $qrisCount = $paymentStats['Qris'] ?? 0;
                        $totalPay = $cashCount + $qrisCount;
                        $cashPerc = $totalPay > 0 ? ($cashCount / $totalPay) * 100 : 0;
                        $qrisPerc = $totalPay > 0 ? ($qrisCount / $totalPay) * 100 : 0;
                    @endphp

                    <div class="mb-3">
                        <div class="d-flex justify-content-between fs-7 mb-1 fw-semibold">
                            <span><i class="bi bi-cash-coin text-success"></i> Tunai (Cash)</span>
                            <span>{{ $cashCount }} ({{ number_format($cashPerc, 1) }}%)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" style="background-color: var(--coffee-caramel); width: {{ $cashPerc }}%"></div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex justify-content-between fs-7 mb-1 fw-semibold">
                            <span><i class="bi bi-qr-code text-info"></i> Non-Tunai (Qris)</span>
                            <span>{{ $qrisCount }} ({{ number_format($qrisPerc, 1) }}%)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" style="background-color: var(--coffee-espresso); width: {{ $qrisPerc }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic Segment Details -->
            <div class="card card-custom shadow-sm mb-4">
                <div class="card-header-custom"><i class="bi bi-pie-chart-fill me-2"></i> Rincian Profil Klaster Penjualan</div>
                <div class="card-body p-4">
                    @if(count($clusterDetails) > 0)
                        @foreach($clusterDetails as $label => $details)
                            <div class="mb-4 pb-3 border-bottom last-border-0">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">
                                        @if(strpos($label, 'Tinggi') !== false)
                                            <span class="badge-coffee-high">Tinggi</span>
                                        @elseif(strpos($label, 'Sedang') !== false)
                                            <span class="badge-coffee-medium">Sedang</span>
                                        @else
                                            <span class="badge-coffee-low">Rendah</span>
                                        @endif
                                    </h6>
                                    <span class="fs-7 fw-bold text-secondary">{{ $details['count'] }} Transaksi ({{ number_format($details['percentage'], 1) }}%)</span>
                                </div>
                                <div class="fs-7 text-muted">
                                    Rata-rata Belanja: <strong class="text-dark">Rp {{ number_format($details['avg_spending']) }}</strong>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4 text-muted fs-7">
                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                            Rincian klaster akan otomatis muncul setelah algoritma K-Means dijalankan.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Suasana & Galeri Kedai -->
            <div class="card card-custom shadow-sm">
                <div class="card-header-custom"><i class="bi bi-images me-2"></i> Suasana Info Coffee</div>
                <div class="card-body p-3">
                    <div id="coffeeCarousel" class="carousel slide rounded-3 overflow-hidden shadow-sm" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#coffeeCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                            <button type="button" data-bs-target="#coffeeCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#coffeeCarousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#coffeeCarousel" data-bs-slide-to="3"></button>
                        </div>
                        <div class="carousel-inner" style="height: 220px;">
                            <div class="carousel-item active h-100">
                                <img src="{{ asset('images/suasana_1.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Suasana Malam Info Coffee">
                                <div class="carousel-caption p-2 bg-dark bg-opacity-50 rounded fs-7 m-2">
                                    <h6 class="mb-0 fw-bold">Area Outdoor Malam</h6>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/suasana_2.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Bar Info Coffee">
                                <div class="carousel-caption p-2 bg-dark bg-opacity-50 rounded fs-7 m-2">
                                    <h6 class="mb-0 fw-bold">Interior Bar & Pelanggan</h6>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/sanger.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Kopi Sanger Dingin">
                                <div class="carousel-caption p-2 bg-dark bg-opacity-50 rounded fs-7 m-2">
                                    <h6 class="mb-0 fw-bold">Kopi Sanger Dingin Khas</h6>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/v60.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="V60 Drip Coffee">
                                <div class="carousel-caption p-2 bg-dark bg-opacity-50 rounded fs-7 m-2">
                                    <h6 class="mb-0 fw-bold">Proses V60 Manual Brew</h6>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#coffeeCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#coffeeCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($clusterStats) > 0)
<style>
    .last-border-0:last-child {
        border-bottom: 0 !important;
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('barChart').getContext('2d');
        
        const labels = {!! json_encode(array_keys($clusterStats)) !!};
        const counts = {!! json_encode(array_values($clusterStats)) !!};

        const coffeeColors = labels.map(label => {
            if (label.includes('Tinggi')) return '#4E342E'; // Mocha
            if (label.includes('Sedang')) return '#8D6E63'; // Caramel
            return '#D7CCC8'; // Latte
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: counts,
                    backgroundColor: coffeeColors,
                    borderColor: '#2B1B17',
                    borderWidth: 1.5,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#3E2723',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: '#E0D4C3'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#3E2723',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endif
@endsection
