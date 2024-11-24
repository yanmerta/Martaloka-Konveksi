<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProgressCustom;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\TransaksiCustomDesign;

class ProgressCustomController extends Controller
{
    public function index()
    {

        $data['judul'] = 'Progres Transaksi Custom';
        $data['transaksi'] = TransaksiCustomDesign::with(['progress' => function($progress){
            $progress->latest();
        }])->where('status_pembayaran', 'Selesai')->get();

        // dd($data['TransaksiCustomDesign']->);
        return view('admin.progress-custom.progress-c-index', $data);
    }

    public function create(TransaksiCustomDesign $transaksi)
    {

        $data['judul'] = 'Progres Transaksi Custom';
        $data['transaksi'] = $transaksi->with(['designs','progress' => function ($query) {
            $query->latest();
        }])->find($transaksi->id);

        // dd($data);
        return view('admin.progress-custom.progress-c-create', $data);
    }


    public function store(Request $request, TransaksiCustomDesign $transaksi)
    {

        // dd($request->all(),$transaksi);
        $file = $request->file('gambar_progress');
        $fileName = $file->getClientOriginalName();
        $time = now()->format('Y-m-d H-i-s');
        $fileSaved = $request->nama_progress . '-' . $time . '-' . $fileName;
        $file->move('progress_custom', $fileSaved);

        $progress = new ProgressCustom();
        $progress->nama_progress = $request->nama_progress;
        $progress->deskripsi_progress = $request->deskripsi_progress;
        $progress->gambar_progress = $fileSaved;
        $progress->custom_id = $transaksi->id;
        $progress->save();


        return redirect()->back();
    }

    public function show(TransaksiCustomDesign $transaksi, ProgressCustom $progress,)
    {

        $data['judul'] = 'Progres Transaksi Custom ' . $progress->nama_progress;
        $data['transaksi'] = $transaksi->with('progress')->find($transaksi->id);
        $data['progress'] = $progress;

        // dd($progress_pembelian);
        return view('admin.progress-custom.progress-c-show', $data);
    }


    public function edit(TransaksiCustomDesign $transaksi,ProgressCustom $progress)
    {

        $data['judul'] = 'Edit progress ' . $progress->nama_progress;
        $data['progress'] = $progress;
        $data['transaksi'] = $transaksi;
        return view('admin.progress-custom.progress-c-edit', $data);
    }


    public function update(Request $request,TransaksiCustomDesign $transaksi, ProgressCustom $progress)
    {
        $file = '';
        $time = now()->format('Y-m-d H-i-s');

        if ($request->has('gambar_progress')) {
            $file = $request->file('gambar_progress');
            $fileName = $file->getClientOriginalName();
            $fileSaved = $request->nama_progress . '-' . $time . $fileName;
            if (File::exists('progress_custom/' . $progress->gambar_progress)) {
                File::delete('progress_custom/' . $progress->gambar_progress);
                $file->move('progress_custom', $fileSaved);
            } else {
                $file->move('progress_custom', $fileSaved);
            }
        } else {
            $fileSaved = $progress->gambar_progress;
        }



        $progress->nama_progress = $request->nama_progress;
        $progress->deskripsi_progress = $request->deskripsi_progress;
        $progress->gambar_progress = $fileSaved;
        $progress->save();

        return redirect()->route('progress-custom.create', $progress->custom_id);
    }

    public function destroy(ProgressCustom $progress)
    {
        $progress->delete();

        return redirect()->route('produk.index');
    }
}
