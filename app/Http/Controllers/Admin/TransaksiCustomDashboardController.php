<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomDesign;
use App\Models\TransaksiCustomDesign;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\TransaksiCustomExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;

class TransaksiCustomDashboardController extends Controller
{
    public function index(Request $request)
    {

        $filter = $request->filter; // Filter berdasarkan status pembayaran
        $search = $request->search; // Pencarian berdasarkan nama user
        $dateRange = $request->date_range;
        $paginate = 10;

        // Query dasar untuk transaksi custom
        $query = TransaksiCustomDesign::with(['user', 'sizes', 'designs']);


        // Pencarian berdasarkan nama user
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        // Filter status pembayaran
        if ($filter) {
            $query->where('status_pembayaran', $filter);
        }

         // Filter berdasarkan rentang tanggal
         if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) == 2) {
                $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]));
                $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]));

                $query->whereBetween('created_at', [
                    $startDate->startOfDay(),
                    $endDate->endOfDay()
                ]);
            }
        }

        // Pagination
        $transaksi = $query->latest()->paginate($paginate);

        return view('admin.custom-design.transaksi-custom-index', [
            'judul' => 'Daftar Transaksi Custom Design',
            'transaksi' => $transaksi,
            'filter' => $filter,
            'search' => $search,
            'dateRange' => $dateRange
        ]);
    }

    public function exportPdf(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;
        $dateRange = $request->date_range;

        $query = TransaksiCustomDesign::with(['user', 'sizes', 'designs']);

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($filter) {
            $query->where('status_pembayaran', $filter);
        }

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) == 2) {
                $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]));
                $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]));

                $query->whereBetween('created_at', [
                    $startDate->startOfDay(),
                    $endDate->endOfDay()
                ]);
            }
        }

        $transaksi = $query->get();

        $pdf = PDF::loadView('admin.custom-design.pdf', [
            'transaksi' => $transaksi,
            'filter' => $filter,
            'search' => $search,
            'dateRange' => $dateRange
        ]);

        return $pdf->download('data-transaksi-custom.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;
        $dateRange = $request->date_range;

        $query = TransaksiCustomDesign::with(['user', 'sizes', 'designs']);

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($filter) {
            $query->where('status_pembayaran', $filter);
        }

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) == 2) {
                $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]));
                $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]));

                $query->whereBetween('created_at', [
                    $startDate->startOfDay(),
                    $endDate->endOfDay()
                ]);
            }
        }

        $transaksi = $query->get();

        return Excel::download(new TransaksiCustomExport($transaksi), 'data-transaksi-custom.xlsx');
    }


    public function show(TransaksiCustomDesign $transaksi)
    {
        // $transaksi = Transaksi::with(['user','detailTransaksi.produk'])->where('user_id',$transaksi->user_id)->find($transaksi->id);

        // dd($transaksi);

        return view('admin.custom-design.transaksi-custom-detail', compact('transaksi'));
    }


    public function terima(Request $request)
    {
        $transaksi = TransaksiCustomDesign::find($request->id);

        $transaksi->update([
            'kurir' => $request->kurir ?? null,
            'no_resi' => $request->no_resi ?? null,
            'tujuan_antar' => $request->tujuan_antar ?? null,
            'tanggal_ambil' => $request->tanggal_ambil ?? null,
            'status_pembayaran' => 'Diterima',
            'tanggal_ambil' => $request->tanggal_ambil
        ]);
        return redirect()->back()->with('success', 'Transaksi Telah Diterima');
    }

    public function tolak(Request $request)
    {
        $transaksi = TransaksiCustomDesign::find($request->id);

        $transaksi->update([
            'status_pembayaran' => 'Ditolak',
            'keterangan_tambahan' => $request->keterangan_tambahan
        ]);
        return redirect()->back()->with('success', 'Transaksi Telah Diterima');
    }

    public function selesaikan(TransaksiCustomDesign $transaksi)
    {

        $transaksi->update(['status_pembayaran' => 'Selesai']);
        return redirect()->back()->with('success', 'Transaksi Telah Selesai');
    }

    public function destroy(TransaksiCustomDesign $transaksi)
    {

        $transaksi->delete();
        return redirect()->back()->with('success', 'Transaksi Telah dihapus');
    }


    public function riwayatTransaksi()
    {
        $transaksiSelesai = TransaksiCustomDesign::with(['user', 'sizes', 'designs'])->whereIn('status_pembayaran', ['Selesai', 'Ditolak'])->get();

        return view('admin.custom-design.transaksi-custom-riwayat', [
            'judul' => 'Riwayat Transaksi Custom',
            'transaksiSelesai' => $transaksiSelesai
        ]);
    }
}
