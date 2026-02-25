<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - SiniBaca</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1a1a1a;
            font-size: 12px;
            line-height: 1.6;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #1a1a1a;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .header p {
            color: #666;
            font-size: 11px;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #555;
            margin-bottom: 20px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 24px;
            text-align: center;
        }

        .summary-box .label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .summary-box .value {
            font-size: 24px;
            font-weight: 800;
            color: #1a1a1a;
            margin-top: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        thead th {
            background: #1a1a1a;
            color: white;
            padding: 10px 12px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-success {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-failed,
        .status-expire,
        .status-cancel,
        .status-deny {
            background: #fee2e2;
            color: #991b1b;
        }

        .amount {
            font-weight: 700;
            font-family: 'Courier New', monospace;
        }

        .footer {
            text-align: center;
            border-top: 2px solid #1a1a1a;
            padding-top: 16px;
            margin-top: 32px;
            color: #999;
            font-size: 10px;
        }

        .signature-area {
            margin-top: 48px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-box .line {
            border-top: 1px solid #333;
            margin-top: 60px;
            padding-top: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .signature-box .role {
            font-size: 10px;
            color: #666;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4f46e5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            z-index: 100;
        }

        .print-btn:hover {
            background: #4338ca;
        }

        @media print {
            .print-btn {
                display: none !important;
            }

            body {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <button class="print-btn" onclick="window.print()">🖨️ Cetak Laporan</button>

    <div class="header">
        <h1>LAPORAN TRANSAKSI PREMIUM</h1>
        <p>SiniBaca — Platform Baca Novel Terpercaya</p>
    </div>

    <div class="meta">
        <div>
            <strong>Periode:</strong>
            @if($dateFrom && $dateTo)
                {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }} —
                {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}
            @elseif($dateFrom)
                Dari {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }}
            @elseif($dateTo)
                Sampai {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}
            @else
                Semua Waktu
            @endif
        </div>
        <div>
            <strong>Status:</strong>
            <span class="status-badge status-{{ $status ?? 'all' }}"
                style="font-size: 10px; {{ !$status ? 'background:#f3f4f6; color:#374151;' : '' }}">
                {{ $status ? ucfirst($status) : 'Semua Status' }}
            </span>
        </div>
        <div>
            <strong>Dicetak:</strong> {{ now()->format('d F Y, H:i') }} WIB
        </div>
    </div>

    <div class="summary-box">
        <div class="label">Total Pendapatan ({{ $transactions->count() }} Transaksi)</div>
        <div class="value">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-family: monospace; font-size: 10px;">{{ Str::limit($transaction->order_id, 24) }}</td>
                    <td>{{ $transaction->user->name ?? 'Deleted' }}</td>
                    <td>{{ $transaction->user->email ?? '-' }}</td>
                    <td class="amount">Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($transaction->payment_type ?? '-') }}</td>
                    <td>
                        <span
                            class="status-badge status-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span>
                    </td>
                    <td>{{ $transaction->transaction_time ? $transaction->transaction_time->format('d/m/Y H:i') : $transaction->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 24px; color: #999;">
                        Tidak ada data transaksi pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-area">
        <div class="signature-box">
            <p style="font-size: 10px; color: #666;">{{ now()->format('d F Y') }}</p>
            <div class="line">Administrator</div>
            <div class="role">Admin SiniBaca</div>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem SiniBaca.</p>
    </div>
</body>

</html>