<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $kategoris = Kategori::all();
        
        return response()->view('sitemap', [
            'produk' => $produks,
            'kategori' => $kategoris
        ])->header('Content-Type', 'text/xml');
    }
}