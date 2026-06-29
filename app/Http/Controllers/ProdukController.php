<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
        }

        $produks = $query->orderBy('kode_produk', 'asc')->paginate(10);
        return view('produk.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => ['required', 'string', 'unique:produks,kode_produk', 'max:20'],
            'nama_produk' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'max:50'],
            'harga' => ['required', 'numeric', 'min:0'],
        ], [
            'kode_produk.unique' => 'Kode produk sudah terdaftar.',
            'kode_produk.required' => 'Kode produk wajib diisi.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'kode_produk' => ['required', 'string', 'max:20', 'unique:produks,kode_produk,' . $produk->id],
            'nama_produk' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'max:50'],
            'harga' => ['required', 'numeric', 'min:0'],
        ], [
            'kode_produk.unique' => 'Kode produk sudah terdaftar.',
            'kode_produk.required' => 'Kode produk wajib diisi.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diubah.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
