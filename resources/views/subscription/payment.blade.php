@extends('layouts.user')

@section('title', 'Pembayaran')

@section('content')
    <div class="min-h-[calc(100vh-4rem)] flex items-center justify-center bg-zinc-950 py-12">
        <div class="max-w-md w-full bg-zinc-900 border border-zinc-800 rounded-2xl shadow-xl p-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-4">Selesaikan Pembayaran</h2>
            <p class="text-zinc-400 mb-8">Silakan selesaikan pembayaran Anda untuk mengaktifkan paket Premium.</p>

            <button id="pay-button"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition-all mb-4">
                Bayar Sekarang
            </button>

            <a href="{{ route('subscription.index') }}" class="text-sm text-zinc-500 hover:text-white">Batalkan</a>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = "{{ route('home') }}?payment=success";
                },
                onPending: function (result) {
                    alert("Wating your payment!"); console.log(result);
                },
                onError: function (result) {
                    alert("Payment failed!"); console.log(result);
                },
                onClose: function () {
                    alert('you closed the popup without finishing the payment');
                }
            })
        };
    </script>
@endsection