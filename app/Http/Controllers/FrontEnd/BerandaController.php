<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiProduk;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CustomDesign;
use App\Models\TransaksiCustomDesign;

class BerandaController extends Controller
{

    public function index()
    {

        $data['kategori'] = Kategori::with('produk')->get();
        $data['products'] = Produk::with('kategori')->orderBy('created_at', 'desc')->take(3)->get();

        // dd(Auth::user());
        return view('home.homepage', $data);
    }


    public function kategori(Kategori $kategori)
    {

        return view('home.kategori', compact('kategori'));
    }

    public function detailProduk(Produk $produk)
    {

        return view('home.detail-produk', compact('produk'));
    }


    public function addToCart(Produk $Produk)
    {
        $keranjang = new Keranjang();
        $qty = 1;
        $user_id = Auth::user()->id;
        // dd($keranjang->where('user_id', $user_id)->where('produk_id', $Produk->id)->where('status', 'Di Keranjang')->exists());
        if ($keranjang->where('user_id', $user_id)->where('produk_id', $Produk->id)->where('status', 'Di Keranjang')->exists()) {
            $keranjang->where('user_id', $user_id)->where('status', 'Di Keranjang')->where('produk_id', $Produk->id)->increment('qty', $qty);
        } else {

            $keranjang->produk_id = $Produk->id;
            $keranjang->user_id = $user_id;
            $keranjang->qty = $qty;
            $keranjang->status = 'Di Keranjang';
            $keranjang->save();
        }

        return to_route('home.keranjang');
    }



    public function transaksi()
    {
        $user_id = Auth::user()->id;
        $transaksis = Transaksi::with(['detailTransaksi.produk.kategori', 'user'])->where('status_pembayaran', 'Dalam Transaksi')->where('user_id', $user_id)->get();

        // dd(($keranjangs));
        return view('home.pembelian-produk.transaksi', compact('transaksis'));
    }


    public function checkout(Request $request)
    {


        if ($request->has('id_')) {
            $keranjangs = Keranjang::with(['produk.kategori', 'user'])->whereIn('id', $request->id_)->update(['status' => 'Dalam Transaksi']);
            $newKeranjang =  Keranjang::with(['produk.kategori', 'user'])->whereIn('id', $request->id_)->get();
        } else {
            $keranjangs = Keranjang::with(['produk.kategori', 'user'])->where('user_id', Auth::user()->id)->update(['status' => 'Dalam Transaksi']);
            $newKeranjang =  Keranjang::with(['produk.kategori', 'user'])->where('user_id', Auth::user()->id)->get();
        }

        $total_harga = 0;


        foreach ($newKeranjang as $item) {
            $price = $item->qty * $item->produk->harga_produk;
            $total_harga += $price;
        }


        $transaksi = new Transaksi();
        $transaksi->user_id = Auth::user()->id;
        $transaksi->status_pembayaran = 'Dalam Transaksi';
        $transaksi->total_harga = $total_harga;
        $transaksi->save();

        // dd($keranjangs[0]->produk->id);


        foreach ($newKeranjang as $cart) {
            $transaksiProduk = new TransaksiProduk();
            $transaksiProduk->transaksi_id = $transaksi->id;
            $transaksiProduk->produk_id = $cart->produk->id;
            $transaksiProduk->total_price = $cart->produk->harga_produk * $cart->qty;
            $transaksiProduk->qty = $cart->qty;
            $transaksiProduk->save();
        }


        return to_route('home.formLengkapiPembelian', ['transaksi' => $transaksi]);
    }


    public function formLengkapiPembelian(Transaksi $transaksi)
    {
        $transaksi =  $transaksi->with(['detailTransaksi.produk.kategori', 'user'])->where('id', $transaksi->id)->first();

        return view('home.pembelian-produk.formulir-pembelian-produk', compact('transaksi'));
    }




    public function formLengkapiTransaksi( Transaksi $transaksi)
    {

        return view('home.pembelian-produk.formulir-pembelian-produk',compact('transaksi'));


    }

    public function lengkapiTransaksiPembelian(Transaksi $transaksi)
    {

    }

    public function uploadBuktiTransaksi(Request $request, Transaksi $transaksi)
    {
        $transaksi = $transaksi->with('user')->where('id', $transaksi->id)->first();
        $file = $request->file('bukti_pembayaran');
        $fileName = $file->getClientOriginalName();
        $time = now()->format('Y-m-d H-i-s');
        $fileSaved = 'Bukti Pembayaran' . '-' . $transaksi->user->name . '-' . $time . $fileName;
        $file->move('bukti_pembayaran', $fileSaved);


        $transaksi->with(['detailTransaksi.produk', 'user'])->where('id', $transaksi->id)->first();
        $transaksi->bukti_pembayaran = $fileSaved;
        $transaksi->status_pembayaran = 'Dibayar';
        $transaksi->save();


        return to_route('home.transaksi');
    }



}
