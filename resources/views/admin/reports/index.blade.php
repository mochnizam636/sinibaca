@extends('admin.layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">Laporan Transaksi</h2>
                <p class="text-sm text-zinc-400 mt-1">Ringkasan pendapatan dan detail transaksi premium.</p>
            </div>
            <a href="{{ route('admin.reports.print', request()->query()) }}" target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition-all shadow-lg shadow-indigo-600/20">
                <i data-lucide="printer" class="w-4 h-4"></i>
                Cetak Laporan
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-emerald-500/10 border border-emerald-500/20 rounded-lg">
                        <i data-lucide="wallet" class="w-5 h-5 text-emerald-400"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Total Pendapatan</p>
                        <h3 class="text-2xl font-bold text-white mt-1">Rp {{ number_format($totalIncome, 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-500/10 border border-indigo-500/20 rounded-lg">
                        <i data-lucide="check-circle" class="w-5 h-5 text-indigo-400"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Transaksi Sukses</p>
                        <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($totalTransactions) }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-amber-500/10 border border-amber-500/20 rounded-lg">
                        <i data-lucide="clock" class="w-5 h-5 text-amber-400"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Menunggu Pembayaran</p>
                        <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($pendingTransactions) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Summary -->
        @if($monthlySummary->count() > 0)
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
                <div class="p-6 border-b border-zinc-800">
                    <h3 class="font-semibold text-white flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="w-4 h-4 text-indigo-400"></i>
                        Ringkasan Bulanan
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800 bg-zinc-950/50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Bulan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Tahun
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Total
                                    Transaksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800/50">
                            @foreach($monthlySummary as $summary)
                                <tr class="hover:bg-zinc-800/30 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-white">
                                        {{ DateTime::createFromFormat('!m', $summary->month)->format('F') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-400">{{ $summary->year }}</td>
                                    <td class="px-6 py-4 text-sm text-zinc-400">{{ number_format($summary->total_transactions) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-emerald-400">Rp
                                        {{ number_format($summary->total_income, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Detail Transactions -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="p-6 border-b border-zinc-800">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h3 class="font-semibold text-white flex items-center gap-2">
                        <i data-lucide="receipt" class="w-4 h-4 text-indigo-400"></i>
                        Detail Transaksi
                    </h3>

                    <!-- Filters -->
                    <div class="flex flex-col sm:flex-row gap-3 items-end sm:items-center">
                        <div class="flex items-center gap-1.5 mr-auto sm:mr-0">
                            <a href="{{ route('admin.reports.index', ['date_from' => now()->startOfMonth()->toDateString(), 'date_to' => now()->endOfMonth()->toDateString(), 'status' => request('status')]) }}"
                                class="text-[10px] px-2 py-1 rounded bg-zinc-800 text-zinc-400 hover:text-white hover:bg-zinc-700 border border-zinc-700 transition-colors {{ request('date_from') == now()->startOfMonth()->toDateString() ? 'bg-indigo-600/20 text-indigo-400 border-indigo-500/30' : '' }}">
                                Bulan Ini
                            </a>
                            <a href="{{ route('admin.reports.index', ['date_from' => now()->subMonth()->startOfMonth()->toDateString(), 'date_to' => now()->subMonth()->endOfMonth()->toDateString(), 'status' => request('status')]) }}"
                                class="text-[10px] px-2 py-1 rounded bg-zinc-800 text-zinc-400 hover:text-white hover:bg-zinc-700 border border-zinc-700 transition-colors {{ request('date_from') == now()->subMonth()->startOfMonth()->toDateString() ? 'bg-indigo-600/20 text-indigo-400 border-indigo-500/30' : '' }}">
                                Bulan Lalu
                            </a>
                        </div>

                        <form method="GET" action="{{ route('admin.reports.index') }}"
                            class="flex flex-wrap items-center gap-2">
                            <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="Dari" onclick="this.showPicker()"
                                class="bg-zinc-950 border border-zinc-800 rounded-lg px-3 py-1.5 text-sm text-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                            <input type="date" name="date_to" value="{{ request('date_to') }}" placeholder="Sampai" onclick="this.showPicker()"
                                class="bg-zinc-950 border border-zinc-800 rounded-lg px-3 py-1.5 text-sm text-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                            <select name="status"
                                class="bg-zinc-950 border border-zinc-800 rounded-lg px-3 py-1.5 text-sm text-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                                <option value="">Semua Status</option>
                                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Sukses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                            <button type="submit"
                                class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 text-white text-sm rounded-lg transition-colors flex items-center gap-1.5">
                                <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                                Filter
                            </button>
                            @if(request()->hasAny(['date_from', 'date_to', 'status']))
                                <a href="{{ route('admin.reports.index') }}"
                                    class="text-xs text-zinc-500 hover:text-white transition-colors">Reset</a>
                            @endif
                        </form>
                    </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-800 bg-zinc-950/50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Metode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800/50">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-zinc-800/30 transition-colors">
                                    <td class="px-6 py-4 text-sm text-zinc-300 font-mono">
                                        {{ Str::limit($transaction->order_id, 20) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-7 h-7 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-xs font-bold">
                                                {{ strtoupper(substr($transaction->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-white">
                                                    {{ $transaction->user->name ?? 'Deleted User' }}</p>
                                                <p class="text-xs text-zinc-500">{{ $transaction->user->email ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-white">Rp
                                        {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'success' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                                'pending' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                                'failed' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                            ];
                                            $color = $statusColors[$transaction->status] ?? 'bg-zinc-800 text-zinc-400 border-zinc-700';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider border {{ $color }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-400">{{ $transaction->payment_type ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-zinc-400">
                                        {{ $transaction->created_at->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <i data-lucide="inbox" class="w-8 h-8 text-zinc-700"></i>
                                            <p class="text-zinc-500 text-sm">Belum ada data transaksi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($transactions->hasPages())
                    <div class="px-6 py-4 border-t border-zinc-800">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
@endsection