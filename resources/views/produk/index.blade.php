@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Manajemen Data Produk</h2>
            <p class="text-muted mb-0">Kelola daftar menu makanan dan minuman Info Coffee.</p>
        </div>
        <button type="button" class="btn btn-coffee rounded-3 px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addProdukModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Menu Baru
        </button>
    </div>

    <!-- Search & Filter Card -->
    <div class="card card-custom shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="{{ route('produk.index') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" value="{{ request('search') }}" placeholder="Cari berdasarkan kode, nama, atau kategori menu...">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-coffee w-100 rounded-3">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Table Card -->
    <div class="card card-custom shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive p-3">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Menu / Produk</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-end">Harga Satuan</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $key => $produk)
                            <tr>
                                <td class="text-center">{{ $produks->firstItem() + $key }}</td>
                                <td><span class="fw-bold text-secondary">{{ $produk->kode_produk }}</span></td>
                                <td><strong>{{ $produk->nama_produk }}</strong></td>
                                <td class="text-center">
                                    @if($produk->kategori == 'Makanan')
                                        <span class="badge" style="background-color: var(--coffee-espresso); color: #fff; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Makanan</span>
                                    @else
                                        <span class="badge" style="background-color: var(--coffee-caramel); color: #fff; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Minuman</span>
                                    @endif
                                </td>
                                <td class="text-end fw-semibold text-dark">Rp {{ number_format($produk->harga) }}</td>
                                <td class="text-center">
                                    <div class="btn-group gap-1">
                                        <button type="button" class="btn btn-sm btn-outline-warning border-0" data-bs-toggle="modal" data-bs-target="#editProdukModal{{ $produk->id }}">
                                            <i class="bi bi-pencil-fill text-warning"></i>
                                        </button>
                                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="d-inline">
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
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-info-circle fs-1 d-block mb-2"></i>
                                    Belum ada data produk terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="px-4 py-3 border-top" style="background-color: #FAF8F5;">
                {{ $produks->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modals (Rendered outside the table for valid HTML and smooth transition) -->
@foreach($produks as $produk)
    <div class="modal fade" id="editProdukModal{{ $produk->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header text-white border-0" style="background-color: var(--coffee-espresso) !important;">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Ubah Menu Produk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Produk</label>
                            <input type="text" name="kode_produk" class="form-control" value="{{ $produk->kode_produk }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="Minuman" {{ $produk->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Makanan" {{ $produk->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" min="0" required>
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProdukModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white border-0" style="background-color: var(--coffee-espresso) !important;">
                <h5 class="modal-title"><i class="bi bi-plus-circle-fill"></i> Tambah Menu Produk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: PRD001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Kopi Cappuccino" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Minuman">Minuman</option>
                            <option value="Makanan">Makanan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                        <input type="number" name="harga" class="form-control" placeholder="Contoh: 15000" min="0" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-coffee">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
