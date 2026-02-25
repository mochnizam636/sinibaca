@extends('layouts.user')

@section('title', 'Berlangganan Premium')

@section('content')
    <div
        class="min-h-[calc(100vh-4rem)] flex items-center justify-center bg-zinc-950 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/10 blur-3xl rounded-full"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/10 blur-3xl rounded-full"></div>
        </div>

        <div class="max-w-md w-full relative z-10">
            <div
                class="bg-zinc-900/50 backdrop-blur-xl border border-zinc-800 rounded-2xl shadow-2xl p-8 text-center hover:border-zinc-700 transition-colors">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-amber-500/20">
                    <i data-lucide="crown" class="w-8 h-8 text-white"></i>
                </div>

                <h2 class="text-3xl font-black text-white mb-2 tracking-tight">Premium Membership</h2>
                <p class="text-zinc-400 mb-8">Nikmati akses tanpa batas ke semua novel premium terbaik.</p>

                <div class="flex items-baseline justify-center gap-1 mb-8">
                    <span class="text-sm font-medium text-zinc-500">Rp</span>
                    <span class="text-5xl font-black text-white tracking-tighter">30000</span>
                    <span class="text-zinc-500">/ bulan</span>
                </div>

                <ul class="space-y-4 text-left mb-8 bg-zinc-950/50 p-6 rounded-xl border border-zinc-800/50">
                    <li class="flex items-center gap-3 text-zinc-300">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                        <span>Akses seluruh novel premium</span>
                    </li>
                    <li class="flex items-center gap-3 text-zinc-300">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                        <span>Bebas iklan (Coming Soon)</span>
                    </li>
                    <li class="flex items-center gap-3 text-zinc-300">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                        <span>Dukungan prioritas</span>
                    </li>
                </ul>

                <form action="{{ route('subscription.pay') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 hover:scale-[1.02] active:scale-[0.98]">
                        Berlangganan Sekarang
                    </button>
                    <p class="mt-4 text-xs text-zinc-500">Pembayaran aman dengan Midtrans via QRIS, E-Wallet, & Transfer
                        Bank.</p>
                </form>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('home') }}"
                    class="text-zinc-500 hover:text-zinc-300 text-sm font-medium transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection