<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        $categories = Kategori::all();
        
        return response()->view('sitemap', [
            'produk' => $products,
            'kategori' => $categories
        ])->header('Content-Type', 'text/xml');
    }
}