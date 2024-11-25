<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Products URLs -->
    @foreach ($produks as $produk)
        <url>
            <loc>{{ url('/product/' . $produk->slug) }}</loc>
            <lastmod>{{ $produk->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Categories URLs -->
    @foreach ($kategoris as $kategori)
        <url>
            <loc>{{ url('/kategori/' . $kategori->slug) }}</loc>
            <lastmod>{{ $kategori->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
