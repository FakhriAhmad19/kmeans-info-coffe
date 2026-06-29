@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Proses K-Means Clustering</h2>
            <p class="text-muted mb-0">Tentukan jumlah klaster dan jalankan algoritma pengelompokan transaksi Info Coffee.</p>
        </div>
        @if($hasResults)
            <a href="{{ route('clustering.results') }}" class="btn btn-coffee-secondary rounded-3 px-4 py-2">
                <i class="bi bi-arrow-right-circle-fill me-1"></i> Lihat Hasil Terakhir
            </a>
        @endif
    </div>

    <!-- Main Grid (Form & Progress) -->
    <div class="row g-4">
        <!-- Configuration Card -->
        <div class="col-md-6">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header-custom"><i class="bi bi-sliders me-2"></i> Konfigurasi K-Means</div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <form action="{{ route('clustering.run') }}" method="POST" id="kMeansForm">
                        @csrf
                        <input type="hidden" name="k" value="3">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted fs-7 text-uppercase">Jumlah Cluster Yang Ditetapkan</label>
                            <div class="p-3 bg-light rounded-3 border d-flex align-items-center gap-3" style="border-color: #E0D4C3 !important;">
                                <span class="badge fs-5 px-3 py-2" style="background-color: var(--coffee-espresso) !important; color: #fff;">K = 3</span>
                                <div>
                                    <strong class="text-dark d-block">3 Segmen Pelanggan</strong>
                                    <span class="fs-7 text-muted">Sesuai ketetapan metodologi Bab IV Proposal Penelitian.</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 p-3 border-0" style="background-color: #FAF5EF; border-radius: 8px; border-left: 4px solid var(--coffee-caramel) !important;">
                            <h6 class="fw-bold mb-2 text-dark"><i class="bi bi-info-circle-fill me-1 text-warning"></i> Keterangan Klaster:</h6>
                            <ul class="mb-0 fs-7 ps-3 text-muted">
                                <li class="mb-1"><strong>Segmen Tinggi (Mocha):</strong> Pelanggan aktif dengan transaksi sering & nominal belanja besar.</li>
                                <li class="mb-1"><strong>Segmen Sedang (Caramel):</strong> Pelanggan dengan keaktifan & nominal belanja menengah.</li>
                                <li><strong>Segmen Rendah (Latte):</strong> Pelanggan dengan transaksi jarang & nominal belanja minimal.</li>
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-coffee w-100 py-3 fw-bold rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2" id="btnProses">
                            <i class="bi bi-play-circle-fill"></i> 
                            <span>MULAI PROSES CLUSTERING</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Steps Progress Indicator -->
        <div class="col-md-6">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-header-custom"><i class="bi bi-hourglass-split me-2"></i> Alur Proses Algoritma</div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="badge rounded-circle p-2 bg-secondary text-white me-3" id="step1">
                            <i class="bi bi-1-circle fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Pra-pemrosesan Data</h6>
                            <span class="fs-7 text-muted" id="step1-text">Pembersihan data transaksi</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="badge rounded-circle p-2 bg-secondary text-white me-3" id="step2">
                            <i class="bi bi-2-circle fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Min-Max Normalisasi</h6>
                            <span class="fs-7 text-muted" id="step2-text">Skala disamakan [0, 1]</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="badge rounded-circle p-2 bg-secondary text-white me-3" id="step3">
                            <i class="bi bi-3-circle fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Iterasi K-Means</h6>
                            <span class="fs-7 text-muted" id="step3-text">Perulangan hingga stabil</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="badge rounded-circle p-2 bg-secondary text-white me-3" id="step4">
                            <i class="bi bi-4-circle fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Evaluasi DBI Score</h6>
                            <span class="fs-7 text-muted" id="step4-text">Penilaian validitas klaster</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('kMeansForm');
        const btn = document.getElementById('btnProses');
        const steps = ['step1', 'step2', 'step3', 'step4'];

        form.addEventListener('submit', function() {
            setTimeout(() => {
                btn.disabled = true;
            }, 50);
            btn.querySelector('span').textContent = 'MEMPROSES ALGORITMA...';
            
            // Simple animated progress effect in browser
            let currentStep = 0;
            const interval = setInterval(() => {
                if(currentStep < steps.length) {
                    const stepElement = document.getElementById(steps[currentStep]);
                    stepElement.classList.remove('bg-secondary');
                    stepElement.classList.add('bg-success');
                    stepElement.innerHTML = '<i class="bi bi-check2 fs-5"></i>';
                    currentStep++;
                } else {
                    clearInterval(interval);
                }
            }, 600);
        });
    });
</script>
@endsection
