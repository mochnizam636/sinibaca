<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Monthly summary
        $monthlySummary = Transaction::where('status', 'success')
            ->select(
                DB::raw('YEAR(transaction_time) as year'),
                DB::raw('MONTH(transaction_time) as month'),
                DB::raw('SUM(gross_amount) as total_income'),
                DB::raw('COUNT(*) as total_transactions')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Detailed transactions with filters
        $query = Transaction::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Stats
        $totalIncome = Transaction::where('status', 'success')->sum('gross_amount');
        $totalTransactions = Transaction::where('status', 'success')->count();
        $pendingTransactions = Transaction::where('status', 'pending')->count();

        return view('admin.reports.index', compact(
            'monthlySummary',
            'transactions',
            'totalIncome',
            'totalTransactions',
            'pendingTransactions'
        ));
    }

    public function print(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();
        // Calculate total income only from success transactions in the filtered set
        $totalIncome = $transactions->where('status', 'success')->sum('gross_amount');

        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
        $status = $request->status;

        return view('admin.reports.print', compact('transactions', 'totalIncome', 'dateFrom', 'dateTo', 'status'));
    }
}
