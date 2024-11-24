<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;
    
        // Atur pagination
        $paginate = 10;
    
        // Query dasar untuk produk
        $query = Produk::with('kategori');
    
        // Pencarian
        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%')
                ->orWhereHas('kategori', function ($q) use ($search) {
                    $q->where('nama_kategori', 'like', '%' . $search . '%');
                })
                ->orWhere('deskripsi', 'like', '%' . $search . '%')
                ->orWhere('harga_produk', 'like', '%' . $search . '%')
                ->orWhere('stok', 'like', '%' . $search . '%');
        }
    
        // Filter kategori
        if ($filter) {
            $query->whereHas('kategori', function ($q) use ($filter) {
                $q->where('nama_kategori', 'like', '%' . $filter . '%');
            });
        }
    
        $produks = $query->latest()->paginate($paginate);
    
        // Mengembalikan view beserta data
        return view('admin.produk.produk-index', [
            'judul' => 'Daftar Produk',
            'produk' => $produks,
            'filter' => $filter,
            'search' => $search
        ]);
    }

    public function create()
    {
        $data['judul'] = 'Tambah Produk';
        $data['kategori'] = Kategori::select('id','nama_kategori')->get();

        // dd(Auth::user());
        return view('admin.produk.produk-create', $data);
    }


    public function store(Request $request)
    {
        $file = $request->file('gambar_produk');
        $fileName = $file->getClientOriginalName();
        $time = now()->format('Y-m-d H-i-s');
        $fileSaved = $request->nama_produk . '-' . $time . $fileName;
        $file->move('produk', $fileSaved);

        $Produk = new Produk();
        $Produk->nama_produk = $request->nama_produk;
        $Produk->kategori_id = $request->kategori_id;
        $Produk->deskripsi = $request->deskripsi;
        $Produk->harga_produk = $request->harga_produk;
        $Produk->stok = $request->stok;
        $Produk->gambar_produk = $fileSaved;
        $Produk->save();


        return redirect()->route('produk.index')->with('success', 'Data produk berhasil Di Tambahkan');
    }

    public function show(Produk $Produk)
    {
        //
    }


    public function edit($id)
    {
        $data['judul'] = 'Edit Data Produk';
        $data['produk'] = Produk::find($id);
        $data['kategori'] = Kategori::select('id','nama_kategori')->get();
        return view('admin.produk.produk-edit ', $data);
    }


    public function update(Request $request, $id)

    {
        $Produk = Produk::find($id);


        $file = '';
        $time = now()->format('Y-m-d H-i-s');

        if ($request->has('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $fileName = $file->getClientOriginalName();
            $fileSaved = $request->nama_produk . '-' . $time . $fileName;
            if (File::exists('produk/' . $Produk->gambar_produk)) {
                File::delete('produk/' . $Produk->gambar_produk);
                $file->move('produk', $fileSaved);
            } else {
                $file->move('produk', $fileSaved);
            }
        } else {
            $fileSaved = $Produk->gambar_produk;
        }




        $Produk->nama_produk = $request->nama_produk;
        $Produk->kategori_id = $request->kategori_id;
        $Produk->deskripsi = $request->deskripsi;
        $Produk->harga_produk = $request->harga_produk;
        $Produk->stok = $request->stok;
        $Produk->gambar_produk = $fileSaved;
        $Produk->save();

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diupdate');
    }

    public function destroy($id)
{
    $produk = Produk::findOrFail($id);
    $produk->delete();

    return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus');
}
}
