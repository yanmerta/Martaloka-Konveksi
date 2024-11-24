<?php

namespace App\Providers;

use App\Models\Kategori;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('dropdown_kategori',Kategori::with('produk')->select('id','nama_kategori')->get());
        });
    }
}
