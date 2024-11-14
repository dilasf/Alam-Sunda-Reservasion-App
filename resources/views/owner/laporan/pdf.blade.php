<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="text-center mb-4">
        <h1>Laporan Transaksi</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($validated['start_date'])->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($validated['end_date'])->format('d/m/Y') }}</p>
    </div>

    @if ($validated['report_type'] == 'reservasi')
        <h2>Laporan Reservasi</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nomor Meja</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah Tamu</th>
                    <th>Status</th>
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $transaksi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ optional($transaksi->reservasi->meja)->nama ?? '-' }}</td>
                        <td>{{ optional($transaksi->reservasi)->nama_depan ?? '-' }}
                            {{ optional($transaksi->reservasi)->nama_belakang ?? '-' }}</td>
                        <td>{{ optional($transaksi->reservasi)->jumlahPengunjung ?? '-' }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>Rp {{ number_format($transaksi->totalPembayaran, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                @if ($data->isNotEmpty())
                    <tr>
                        <td colspan="6" style="text-align: right;"><strong>Total:</strong></td>
                        <td><strong>Rp {{ number_format($data->sum('totalPembayaran'), 0, ',', '.') }}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    @else
        <h2>Laporan Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Pemesan</th>
                    <th>Tipe Pesanan</th>
                    <th>Status Pesanan</th>
                    <th>Status Pengiriman</th>
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $transaksi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ optional($transaksi->pesanan->user)->name ?? '-' }}</td>
                        <td>{{ optional($transaksi->pesanan)->tipePesanan ?? '-' }}</td>
                        <td>{{ optional($transaksi->pesanan)->status ?? '-' }}</td>
                        <td>{{ optional($transaksi->pesanan->pengiriman)->status ?? '-' }}</td>
                        <td>Rp {{ number_format($transaksi->totalPembayaran, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                @if ($data->isNotEmpty())
                    <tr>
                        <td colspan="6" style="text-align: right;"><strong>Total:</strong></td>
                        <td><strong>Rp {{ number_format($data->sum('totalPembayaran'), 0, ',', '.') }}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif
</body>

</html>
