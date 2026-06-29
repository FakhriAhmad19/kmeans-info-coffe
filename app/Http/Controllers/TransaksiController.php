<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['items.product']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('kode_transaksi', 'like', '%' . $search . '%')
                  ->orWhere('pembayaran', 'like', '%' . $search . '%')
                  ->orWhere('shift', 'like', '%' . $search . '%')
                  ->orWhereHas('items.product', function ($q) use ($search) {
                      $q->where('nama_produk', 'like', '%' . $search . '%');
                  });
        }

        $transaksis = $query->orderBy('kode_transaksi', 'desc')->paginate(15);
        $produks = Produk::orderBy('nama_produk', 'asc')->get();
        return view('transaksi.index', compact('transaksis', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => ['required', 'string', 'max:20'],
            'tanggal' => ['required', 'date'],
            'pembayaran' => ['required', 'string', 'max:50'],
            'shift' => ['required', 'string', 'max:20'],
            'produk_id' => ['required', 'exists:produks,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ], [
            'kode_transaksi.required' => 'ID Transaksi wajib diisi.',
            'produk_id.exists' => 'Produk tidak valid.',
            'qty.min' => 'Jumlah minimal 1.',
        ]);

        try {
            DB::beginTransaction();

            $produk = Produk::findOrFail($request->produk_id);
            $hargaSatuan = $produk->harga;
            $subtotal = $hargaSatuan * $request->qty;

            $transaksi = Transaksi::create([
                'kode_transaksi' => $request->kode_transaksi,
                'tanggal' => $request->tanggal,
                'pembayaran' => $request->pembayaran,
                'shift' => $request->shift,
                'total_belanja' => $subtotal
            ]);

            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk->id,
                'qty' => $request->qty,
                'harga_satuan' => $hargaSatuan
            ]);

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['kode_transaksi' => 'Gagal menambah transaksi: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'tanggal' => ['required', 'date'],
            'pembayaran' => ['required', 'string', 'max:50'],
            'shift' => ['required', 'string', 'max:20'],
        ]);

        $transaksi->update([
            'tanggal' => $request->tanggal,
            'pembayaran' => $request->pembayaran,
            'shift' => $request->shift
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diubah.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt'],
        ], [
            'csv_file.required' => 'File CSV wajib diunggah.',
            'csv_file.mimes' => 'Format file harus berupa .csv',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        
        $handle = fopen($path, 'r');
        if (!$handle) {
            return back()->withErrors(['csv_file' => 'Gagal membaca file CSV.']);
        }

        $header = fgetcsv($handle, 1000, ';');
        if (!$header) {
            $header = fgetcsv($handle, 1000, ',');
        }

        $importCount = 0;

        try {
            DB::beginTransaction();

            while (($row = fgetcsv($handle, 1000, ';')) !== false || ($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (empty($row) || count($row) < 5) continue;
                
                $kodeTransaksi = trim($row[0]);
                $tanggalRaw = trim($row[1]);
                $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $tanggalRaw)));
                
                $namaMenu = trim($row[3]);
                $kategoriMenu = trim($row[4]);
                $qty = intval($row[5]);
                $hargaSatuan = intval(preg_replace('/[^0-9]/', '', $row[6]));
                $totalBelanja = intval(preg_replace('/[^0-9]/', '', $row[7]));
                $pembayaran = trim($row[8]);
                $shift = trim($row[9]);

                $produk = Produk::firstOrCreate(
                    ['nama_produk' => $namaMenu],
                    [
                        'kode_produk' => 'PRD' . str_pad(Produk::count() + 1, 3, '0', STR_PAD_LEFT),
                        'kategori' => $kategoriMenu,
                        'harga' => $hargaSatuan
                    ]
                );

                $transaksi = Transaksi::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'tanggal' => $tanggal,
                    'total_belanja' => $totalBelanja,
                    'pembayaran' => $pembayaran,
                    'shift' => $shift
                ]);

                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'qty' => $qty,
                    'harga_satuan' => $hargaSatuan
                ]);

                $importCount++;
            }

            DB::commit();
            fclose($handle);

            return redirect()->route('transaksi.index')->with('success', "Berhasil mengimpor $importCount baris data transaksi.");
        } catch (\Exception $e) {
            DB::rollBack();
            if ($handle) fclose($handle);
            return back()->withErrors(['csv_file' => 'Error saat memproses baris CSV: ' . $e->getMessage()]);
        }
    }
}
