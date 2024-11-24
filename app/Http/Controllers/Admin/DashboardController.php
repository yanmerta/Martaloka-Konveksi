<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use App\Models\TransaksiCustomDesign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year); 
        $startDate = Carbon::createFromDate($year)->startOfYear();
        $endDate = Carbon::createFromDate($year)->endOfYear();

        $data['jumlah_pengguna'] = User::count();
        $data['jumlah_produk'] = Produk::count();
        $data['jumlah_transaksiproduk'] = Transaksi::count();
        $data['jumlah_transaksicostum'] = TransaksiCustomDesign::count();

        // Tambahkan data transaksi terbaru
        $data['transaksi_terbaru'] = Transaksi::with(['user', 'detailTransaksi.produk'])
                                        ->latest()
                                        ->take(5)
                                        ->get();

        // Get regular transactions with revenue (only completed transactions)
        $regularTransactions = Transaksi::where('status_pembayaran', 'Selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('SUM(total_harga) as revenue, COUNT(*) as count, DATE_FORMAT(created_at, "%b %Y") as month, YEAR(created_at) as year, MONTH(created_at) as month_num')
            ->groupBy('year', 'month_num', 'month')
            ->orderBy('year')
            ->orderBy('month_num')
            ->get();

        // Get custom transactions with revenue (only completed transactions)
        $customTransactions = TransaksiCustomDesign::where('status_pembayaran', 'Selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('SUM(total_harga) as revenue, COUNT(*) as count, DATE_FORMAT(created_at, "%b %Y") as month, YEAR(created_at) as year, MONTH(created_at) as month_num')
            ->groupBy('year', 'month_num', 'month')
            ->orderBy('year')
            ->orderBy('month_num')
            ->get();

        // Get all transactions for transaction count (regardless of status)
        $allRegularTransactions = Transaksi::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%b %Y") as month, YEAR(created_at) as year, MONTH(created_at) as month_num')
            ->groupBy('year', 'month_num', 'month')
            ->orderBy('year')
            ->orderBy('month_num')
            ->get();

        $allCustomTransactions = TransaksiCustomDesign::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%b %Y") as month, YEAR(created_at) as year, MONTH(created_at) as month_num')
            ->groupBy('year', 'month_num', 'month')
            ->orderBy('year')
            ->orderBy('month_num')
            ->get();

        // Initialize period arrays
        $period = [];
        for ($i = 1; $i <= 12; $i++) {
            $date = Carbon::createFromDate($year, $i, 1);
            $key = $date->format('M');
            $period[$key] = 0;
        }

        // Prepare data arrays
        $transactionsPeriod = $period;
        $customTransactionsPeriod = $period;
        $revenuePeriod = $period;
        $customRevenuePeriod = $period;

        // Fill regular transaction count data (all transactions)
        foreach ($allRegularTransactions as $transaction) {
            $month = Carbon::parse($transaction->month)->format('M');
            $transactionsPeriod[$month] = $transaction->count;
        }

        // Fill custom transaction count data (all transactions)
        foreach ($allCustomTransactions as $transaction) {
            $month = Carbon::parse($transaction->month)->format('M');
            $customTransactionsPeriod[$month] = $transaction->count;
        }

        // Fill revenue data (only completed transactions)
        foreach ($regularTransactions as $transaction) {
            $month = Carbon::parse($transaction->month)->format('M');
            $revenuePeriod[$month] = $transaction->revenue;
        }

        foreach ($customTransactions as $transaction) {
            $month = Carbon::parse($transaction->month)->format('M');
            $customRevenuePeriod[$month] = $transaction->revenue;
        }

        // Prepare final data arrays
        $data['labels'] = array_keys($period);
        $data['produkData'] = array_values($transactionsPeriod);
        $data['customData'] = array_values($customTransactionsPeriod);
        $data['revenueData'] = array_values($revenuePeriod);
        $data['customRevenueData'] = array_values($customRevenuePeriod);

        // Calculate totals
        $data['totalProduk'] = array_sum($data['produkData']);
        $data['totalCustom'] = array_sum($data['customData']);
        
        // Calculate total revenue (only from completed transactions)
        $data['totalRevenue'] = Transaksi::where('status_pembayaran', 'Selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_harga');
            
        $data['totalCustomRevenue'] = TransaksiCustomDesign::where('status_pembayaran', 'Selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_harga');

        $data['selectedYear'] = $year;

        return view('admin.dashboard', $data);
    }
}