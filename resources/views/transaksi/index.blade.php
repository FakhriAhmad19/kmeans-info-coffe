@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Log Transaksi Penjualan</h2>
            <p class="text-muted mb-0">Daftar transaksi penjualan Info Coffee yang digunakan untuk basis clustering.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-coffee-secondary rounded-3 px-4 py-2" data-bs-toggle="modal" data-bs-target="#importCsvModal">
                <i class="bi bi-file-earmark-arrow-up-fill me-1"></i> Impor CSV
            </button>
            <button type="button" class="btn btn-coffee rounded-3 px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addTransaksiModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-custom shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="{{ route('transaksi.index') }}" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" value="{{ request('search') }}" placeholder="Cari berdasarkan kode nota / ID Transaksi...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="pembayaran" class="form-select">
                        <option value="">-- Semua Pembayaran --</option>
                        <option value="Cash" {{ request('pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Qris" {{ request('pembayaran') == 'Qris' ? 'selected' : '' }}>Qris</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="shift" class="form-select">
                        <option value="">-- Semua Shift --</option>
                        <option value="Siang" {{ request('shift') == 'Siang' ? 'selected' : '' }}>Siang</option>
                        <option value="Malam" {{ request('shift') == 'Malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-coffee w-100 rounded-3">Filter & Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Transaction Table Card -->
    <div class="card card-custom shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive p-3">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">No</th>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Daftar Pembelian Item (Qty)</th>
                            <th class="text-center">Pembayaran</th>
                            <th class="text-center">Shift</th>
                            <th class="text-end">Total Belanja</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $key => $transaksi)
                            <tr>
                                <td class="text-center">{{ $transaksis->firstItem() + $key }}</td>
                                <td><span class="fw-bold text-secondary">{{ $transaksi->kode_transaksi }}</span></td>
                                <td>{{ date('d/m/Y', strtotime($transaksi->tanggal)) }}</td>
                                <td>
                                    <ul class="mb-0 ps-3 fs-7">
                                        @foreach($transaksi->items as $item)
                                            <li>{{ $item->product->nama_produk ?? 'Menu' }} ({{ $item->qty }}x)</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $transaksi->pembayaran == 'Cash' ? 'bg-light text-dark border' : 'bg-info text-white' }}" style="padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                        {{ $transaksi->pembayaran }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge" style="background-color: var(--coffee-caramel); color: #fff; padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                        {{ $transaksi->shift }}
                                    </span>
                                </td>
                                <td class="text-end fw-semibold text-dark">Rp {{ number_format($transaksi->total_belanja) }}</td>
                                <td class="text-center">
                                    <div class="btn-group gap-1">
                                        <button type="button" class="btn btn-sm btn-outline-warning border-0" data-bs-toggle="modal" data-bs-target="#editTransaksiModal{{ $transaksi->id }}">
                                            <i class="bi bi-pencil-fill text-warning"></i>
                                        </button>
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi ini?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash-fill text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-receipt-cutoff fs-1 d-block mb-2"></i>
                                    Belum ada data transaksi tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="px-4 py-3 border-top" style="background-color: #FAF8F5;">
                {{ $transaksis->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Transaksi Modals (Rendered outside the table for valid HTML and smooth transition) -->
@foreach($transaksis as $transaksi)
    <div class="modal fade" id="editTransaksiModal{{ $transaksi->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white border-0" style="background-color: var(--coffee-espresso) !important;">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Ubah Transaksi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID Transaksi (Kode)</label>
                            <input type="text" class="form-control" value="{{ $transaksi->kode_transaksi }}" readonly disabled>
                            <div class="form-text text-muted">ID Transaksi tidak dapat diubah.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $transaksi->tanggal }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pembayaran</label>
                            <select name="pembayaran" class="form-select" required>
                                <option value="Cash" {{ $transaksi->pembayaran == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Qris" {{ $transaksi->pembayaran == 'Qris' ? 'selected' : '' }}>Qris</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Shift</label>
                            <select name="shift" class="form-select" required>
                                <option value="Siang" {{ $transaksi->shift == 'Siang' ? 'selected' : '' }}>Siang</option>
                                <option value="Malam" {{ $transaksi->shift == 'Malam' ? 'selected' : '' }}>Malam</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-coffee">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Add Transaksi Modal -->
<div class="modal fade" id="addTransaksiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white border-0" style="background-color: var(--coffee-espresso) !important;">
                <h5 class="modal-title"><i class="bi bi-plus-circle-fill"></i> Tambah Transaksi Manual</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">ID Transaksi (Kode)</label>
                        <input type="text" name="kode_transaksi" class="form-control" placeholder="Contoh: T-191" required>
                        <div class="form-text text-muted">Jika ID Transaksi sama dengan yang sudah ada, item menu baru akan ditambahkan ke nota tersebut.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pembayaran</label>
                            <select name="pembayaran" class="form-select" required>
                                <option value="Cash">Cash</option>
                                <option value="Qris">Qris</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Shift</label>
                            <select name="shift" class="form-select" required>
                                <option value="Malam">Malam</option>
                                <option value="Siang">Siang</option>
                            </select>
                        </div>
                    </div>
                    <div class="border-top pt-3 mt-3">
                        <h6 class="fw-bold mb-3 text-secondary"><i class="bi bi-cart-plus-fill"></i> Masukkan Item Menu</h6>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Menu / Produk</label>
                            <select name="produk_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Menu Produk --</option>
                                @foreach($produks as $p)
                                    <option value="{{ $p->id }}">{{ $p->kode_produk }} - {{ $p->nama_produk }} (Rp {{ number_format($p->harga) }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Beli (Qty)</label>
                            <input type="number" name="qty" class="form-control" value="1" min="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-coffee">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import CSV Modal -->
<div class="modal fade" id="importCsvModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white border-0" style="background-color: var(--coffee-espresso) !important;">
                <h5 class="modal-title"><i class="bi bi-file-earmark-arrow-up-fill"></i> Impor Transaksi (CSV)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transaksi.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <p class="fs-7 text-muted mb-3">Format file CSV harus dipisahkan oleh tanda titik koma (;) atau koma (,) dengan urutan kolom berikut:</p>
                    <div class="bg-light p-2 rounded mb-3" style="font-family: monospace; font-size: 0.75rem;">
                        No Transaksi;Tanggal;Jam;Nama Menu;Kategori Menu;Qty;Harga Satuan;Total;Pembayaran;Shift
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Pilih File CSV</label>
                        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                    </div>

                    <div class="border-top pt-2">
                        <i class="bi bi-info-circle text-info me-1"></i>
                        <span class="fs-7 text-muted">Kami telah menyediakan berkas contoh data transaksi di folder proyek Anda: <code class="bg-light px-1">sample_data.csv</code></span>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-coffee">Mulai Impor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
