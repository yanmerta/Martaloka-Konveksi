<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\ProgressPembelian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class ProgressPembelianController extends Controller
{
    public function index()
    {

        $data['judul'] = 'Progres Transaksi Pembelian';
        $data['transaksi'] = Transaksi::with(['progress' => function($progress){
            $progress->latest();
        }])->where('status_pembayaran', 'Selesai')->get();

        // dd($data['transaksi']->);
        return view('admin.progress-pembelian.progress-p-index', $data);
    }

    public function create(Transaksi $transaksi)
    {

        $data['judul'] = 'Progres Transaksi Pembelian';
        $data['transaksi'] = $transaksi->with(['progress' => function ($query) {
            $query->latest();
        }])->find($transaksi->id);

        // dd($data);
        return view('admin.progress-pembelian.progress-p-create', $data);
    }


    public function store(Request $request, Transaksi $transaksi)
    {

        // dd($request->all(),$transaksi);
        $file = $request->file('gambar_progress');
        $fileName = $file->getClientOriginalName();
        $time = now()->format('Y-m-d H-i-s');
        $fileSaved = $request->nama_progress . '-' . $time . '-' . $fileName;
        $file->move('progress_pembelian', $fileSaved);

        $progress = new ProgressPembelian();
        $progress->nama_progress = $request->nama_progress;
        $progress->deskripsi_progress = $request->deskripsi_progress;
        $progress->gambar_progress = $fileSaved;
        $progress->transaksi_id = $transaksi->id;
        $progress->save();


        return redirect()->back();
    }

    public function show(Transaksi $transaksi, ProgressPembelian $progress,)
    {

        $data['judul'] = 'Progres Transaksi Pembelian ' . $progress->nama_progress;
        $data['transaksi'] = $transaksi->with('progress')->find($transaksi->id);
        $data['progress'] = $progress;

        // dd($progress_pembelian);
        return view('admin.progress-pembelian.progress-p-show', $data);
    }


    public function edit(Transaksi $transaksi,ProgressPembelian $progress)
    {

        $data['judul'] = 'Edit progress ' . $progress->nama_progress;
        $data['progress'] = $progress;
        $data['transaksi'] = $transaksi;
        return view('admin.progress-pembelian.progress-p-edit', $data);
    }


    public function update(Request $request,Transaksi $transaksi, ProgressPembelian $progress)
    {
        $file = '';
        $time = now()->format('Y-m-d H-i-s');

        if ($request->has('gambar_progress')) {
            $file = $request->file('gambar_progress');
            $fileName = $file->getClientOriginalName();
            $fileSaved = $request->nama_progress . '-' . $time . $fileName;
            if (File::exists('progress_pembelian/' . $progress->gambar_progress)) {
                File::delete('progress_pembelian/' . $progress->gambar_progress);
                $file->move('progress_pembelian', $fileSaved);
            } else {
                $file->move('progress_pembelian', $fileSaved);
            }
        } else {
            $fileSaved = $progress->gambar_progress;
        }



        $progress->nama_progress = $request->nama_progress;
        $progress->deskripsi_progress = $request->deskripsi_progress;
        $progress->gambar_progress = $fileSaved;
        $progress->save();

        return redirect()->route('progress-pembelian.create', $progress->transaksi_id);
    }

    public function destroy(ProgressPembelian $progress)
    {
        $progress->delete();

        return redirect()->route('produk.index');
    }
}
