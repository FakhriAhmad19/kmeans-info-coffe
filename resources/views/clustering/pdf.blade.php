<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Segmentasi Pelanggan Info Coffee</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 11px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #5D4037;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #2B1B17;
            margin: 0;
        }

        .subtitle {
            font-size: 12px;
            color: #8D6E63;
            margin: 5px 0 0 0;
            font-weight: bold;
        }

        .doc-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #4E342E;
            margin: 15px 0;
            text-transform: uppercase;
        }

        .meta-info {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .meta-info td {
            padding: 4px 0;
        }

        .meta-label {
            font-weight: bold;
            color: #5D4037;
            width: 120px;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .table-data th {
            background-color: #4E342E;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            padding: 8px 10px;
            border: 1px solid #4E342E;
        }

        .table-data td {
            padding: 8px 10px;
            border: 1px solid #E0D4C3;
            text-align: center;
        }

        .table-data tbody tr:nth-child(even) {
            background-color: #FDFBF7;
        }

        .table-summary {
            background-color: #D7CCC8 !important;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }

        .badge-high {
            background-color: #4E342E;
            color: #ffffff;
        }

        .badge-medium {
            background-color: #8D6E63;
            color: #ffffff;
        }

        .badge-low {
            background-color: #D7CCC8;
            color: #3E2723;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #8D6E63;
            border-top: 1px solid #E0D4C3;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="brand-title">INFO COFFEE SYSTEM</div>
        <div class="subtitle">K-Means Customer Segmentation & Analytics</div>
    </div>

    <!-- Document Title -->
    <div class="doc-title">Laporan Analisis Segmentasi Pelanggan</div>

    <!-- Meta Information -->
    <table class="meta-info">
        <tr>
            <td class="meta-label">Tanggal Cetak:</td>
            <td>{{ date('d/m/Y H:i') }}</td>
            <td class="meta-label">Jumlah Cluster (K):</td>
            <td>{{ count($labels) }}</td>
        </tr>
        <tr>
            <td class="meta-label">Total Data:</td>
            <td>{{ $totalData }} Transaksi</td>
            <td class="meta-label">DBI Evaluation Score:</td>
            <td><strong>{{ number_format($dbi, 3) }}</strong> ({{ $dbi <= 1.0 ? 'Kualitas Optimal' : 'Kurang Optimal' }})</td>
        </tr>
    </table>

    <!-- Summary Section Header -->
    <h3 style="color: #4E342E; border-bottom: 1px solid #E0D4C3; padding-bottom: 5px; margin-bottom: 10px;">I. Ringkasan Kinerja Klaster</h3>
    <table class="table-data">
        <thead>
            <tr>
                <th>Nama Cluster</th>
                <th>Kategori Segmen</th>
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
                    <td><strong>Cluster {{ $row['cluster'] }}</strong></td>
                    <td>
                        @if(strpos($row['keterangan'], 'Tinggi') !== false)
                            <span class="badge badge-high">Tinggi</span>
                        @elseif(strpos($row['keterangan'], 'Sedang') !== false)
                            <span class="badge badge-medium">Sedang</span>
                        @else
                            <span class="badge badge-low">Rendah</span>
                        @endif
                    </td>
                    <td>{{ $row['jumlah_anggota'] }}</td>
                    <td>{{ number_format($row['persentase'], 1) }}%</td>
                    <td>Rp {{ number_format($row['rata_belanja']) }}</td>
                    <td><strong>Rp {{ number_format($row['total_belanja']) }}</strong></td>
                </tr>
            @endforeach
            <tr class="table-summary">
                <td colspan="2">TOTAL KESELURUHAN</td>
                <td>{{ $grandTotalMembers }}</td>
                <td>100.0%</td>
                <td>Rp {{ number_format($grandTotalMembers > 0 ? $grandTotalSpend / $grandTotalMembers : 0) }}</td>
                <td>Rp {{ number_format($grandTotalSpend) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Detailed Section Header -->
    <h3 style="color: #4E342E; border-bottom: 1px solid #E0D4C3; padding-bottom: 5px; margin-bottom: 10px;">II. Rincian Data Transaksi Terklasifikasi</h3>
    <table class="table-data" style="font-size: 10px;">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Rata Item</th>
                <th>Total Qty</th>
                <th>Total Belanja</th>
                <th>Kategori Segmen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $row['kode_transaksi'] }}</strong></td>
                    <td>{{ date('d/m/Y', strtotime($row['tanggal'])) }}</td>
                    <td>{{ $row['frekuensi'] }}</td>
                    <td>{{ $row['total_qty'] }}</td>
                    <td>Rp {{ number_format($row['total_belanja']) }}</td>
                    <td>
                        @if(strpos($row['keterangan'], 'Tinggi') !== false)
                            Tinggi (Mocha)
                        @elseif(strpos($row['keterangan'], 'Sedang') !== false)
                            Sedang (Caramel)
                        @else
                            Rendah (Latte)
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Laporan Analisis Penjualan - Info Coffee &copy; 2026. Dicetak secara sistematis menggunakan Laravel K-Means.
    </div>

</body>
</html>
