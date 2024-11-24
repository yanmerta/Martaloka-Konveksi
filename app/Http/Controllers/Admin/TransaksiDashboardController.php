<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use App\Models\TransaksiCustomDesign;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\TransaksiExport;



use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF; // Tambahkan ini


class TransaksiDashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter; // Filter status pembayaran
        $search = $request->search; // Pencarian berdasarkan user atau produk
        $dateRange = $request->date_range; // Range tanggal dari daterangepicker
        $paginate = 10;

        // Query dasar untuk transaksi
        $query = Transaksi::with(['user', 'detailTransaksi.produk']);

        // Pencarian
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
                ->orWhereHas('detailTransaksi.produk', function ($q) use ($search) {
                    $q->where('nama_produk', 'like', '%' . $search . '%');
                });
        }

        // Filter status pembayaran
        if ($filter) {
            $query->where('status_pembayaran', $filter);
        }

        // Filter berdasarkan tanggal
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

        return view('admin.transaksi.transaksi-index', [
            'judul' => 'Data Transaksi Produk',
            'transaksi' => $transaksi,
            'filter' => $filter,
            'search' => $search,
            'dateRange' => $dateRange
        ]);
    }

    public function exportPdf(Request $request)
    {
        $filter = $request->filter; // Filter status pembayaran
        $search = $request->search; // Pencarian berdasarkan user atau produk
        $dateRange = $request->date_range; // Range tanggal dari daterangepicker

        // Query dasar untuk transaksi
        $query = Transaksi::with(['user', 'detailTransaksi.produk']);

        // Pencarian
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
                ->orWhereHas('detailTransaksi.produk', function ($q) use ($search) {
                    $q->where('nama_produk', 'like', '%' . $search . '%');
                });
        }

        // Filter status pembayaran
        if ($filter) {
            $query->where('status_pembayaran', $filter);
        }

        // Filter berdasarkan tanggal
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

        // Mengambil data berdasarkan query yang telah difilter
        $transaksi = $query->get();

        // Membuat PDF
        $pdf = PDF::loadView('admin.transaksi.pdf', [
            'transaksi' => $transaksi,
            'filter' => $filter,
            'search' => $search,
            'dateRange' => $dateRange
        ]);

        return $pdf->download('data-transaksi.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filter = $request->filter; // Filter status pembayaran
        $search = $request->search; // Pencarian berdasarkan user atau produk
        $dateRange = $request->date_range; // Range tanggal dari daterangepicker

        // Query dasar untuk transaksi
        $query = Transaksi::with(['user', 'detailTransaksi.produk']);

        // Pencarian
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
                ->orWhereHas('detailTransaksi.produk', function ($q) use ($search) {
                    $q->where('nama_produk', 'like', '%' . $search . '%');
                });
        }

        // Filter status pembayaran
        if ($filter) {
            $query->where('status_pembayaran', $filter);
        }

        // Filter berdasarkan tanggal
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

        // Mengambil data berdasarkan query yang telah difilter
        $transaksi = $query->get();

        return Excel::download(new TransaksiExport($transaksi), 'data-transaksi.xlsx');
    }




    public function show(Transaksi $transaksi)
    {
        // $transaksi = Transaksi::with(['user','detailTransaksi.produk'])->where('user_id',$transaksi->user_id)->find($transaksi->id);

        // dd($transaksi);

        return view('admin.transaksi.transaksi-detail', compact('transaksi'));
    }


    public function terima(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
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

    public function tolak(Transaksi $transaksi, Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $transaksi->update(
            [
                'status_pembayaran' => 'Ditolak',
                'keterangan_tambahan' => $request->keterangan_tambahan
            ]
        );
        return redirect()->back()->with('success', 'Transaksi Telah Diperbarui');
    }

    public function selesaikan(Transaksi $transaksi)
    {

        $transaksi->update(['status_pembayaran' => 'Selesai']);
        return redirect()->back()->with('success', 'Transaksi Telah Diterima');
    }


    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->back()->with('success', 'Transaksi Telah dihapus');
    }


    public function riwayatTransaksi()
    {
        $transaksiSelesai = Transaksi::with(['user', 'detailTransaksi.produk'])->whereIn('status_pembayaran', ['Selesai', 'Ditolak'])->get();

        return view('admin.transaksi.transaksi-riwayat', [
            'judul' => 'Riwayat Transaksi Produk',
            'transaksiSelesai' => $transaksiSelesai
        ]);
    }

    public function riwayatTransaksiCustom()
    {
        $transaksiSelesai = TransaksiCustomDesign::with(['user', 'detailTransaksi.produk'])->where('status_pembayaran', 'Selesai')->get();

        return view('admin.transaksi.transaksi-riwayat', compact('transaksiSelesai'));
    }
}
