<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index');
    }

    public function subscribe(Request $request, MidtransService $midtrans)
    {
        $user = auth()->user();
        if ($user->isPremium()) {
            return redirect()->back()->with('error', 'Anda sudah berlangganan Premium.');
        }

        $orderId = 'SUB-' . Str::uuid();
        $price = 30000; // Harga premium 1 bulan

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'PREMIUM_1_MONTH',
                    'price' => $price,
                    'quantity' => 1,
                    'name' => 'Premium Membership (1 Bulan)',
                ]
            ],
        ];

        $snapToken = $midtrans->createSnapToken($params);

        // Simpan transaksi
        Transaction::create([
            'user_id' => $user->id,
            'order_id' => $orderId,
            'gross_amount' => $price,
            'status' => 'pending',
            'payment_type' => 'midtrans',
        ]);

        return view('subscription.payment', compact('snapToken'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        \Illuminate\Support\Facades\Log::info('Midtrans Callback Hit', [
            'order_id' => $request->order_id,
            'status_code' => $request->status_code,
            'gross_amount' => $request->gross_amount,
            'signature_key' => $request->signature_key,
            'calculated_hash' => $hashed,
            'request_all' => $request->all(),
        ]);

        if ($hashed == $request->signature_key) {
            \Illuminate\Support\Facades\Log::info('Signature Matched');
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            if ($transaction) {
                $status = $request->transaction_status;

                if ($status == 'capture' || $status == 'settlement') {
                    \Illuminate\Support\Facades\Log::info('Payment Success: ' . $status);
                    $transaction->update(['status' => 'success', 'transaction_time' => now()]);

                    // Activate Subscription
                    Subscription::create([
                        'user_id' => $transaction->user_id,
                        'status' => 'active',
                        'starts_at' => now(),
                        'expires_at' => now()->addMonth(),
                        'payment_method' => 'midtrans',
                    ]);

                } elseif ($status == 'expire' || $status == 'cancel' || $status == 'deny') {
                    $transaction->update(['status' => 'failed']);
                } else {
                    $transaction->update(['status' => 'pending']);
                }
            } else {
                \Illuminate\Support\Facades\Log::warning('Transaction Not Found: ' . $request->order_id);
            }
        } else {
            \Illuminate\Support\Facades\Log::error('Signature Mismatch');
        }
        return response()->json(['status' => 'ok']);
    }
}
