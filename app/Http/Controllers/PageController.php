<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * 1. HALAMAN UTAMA (Home)
     * Mengambil kategori unik dan produk terbaru untuk dipajang.
     */
    public function index() 
    {
        // Ambil kategori unik yang ada di database untuk filter navigasi cepat
        $categories = Product::distinct()->pluck('category');
        
        // HOME: Ambil 8 produk terbaru saja agar loading halaman depan ringan
        $products = Product::latest()->take(8)->get(); 

        return view('pages.home', compact('products', 'categories'));
    }

    /**
     * 2. KATALOG PUBLIK
     * Menangani filter kategori dan pencarian nama produk.
     */
    public function katalog(Request $request)
    {
        // Ambil daftar kategori unik untuk dropdown/sidebar filter
        $categories = Product::distinct()->pluck('category');
        
        $currentCat = $request->query('category');
        $search = $request->query('search');

        $products = Product::query()
            // Filter Berdasarkan Kategori
            ->when($currentCat && $currentCat !== 'Semua', function ($query) use ($currentCat) {
                return $query->where('category', $currentCat);
            })
            // Filter Berdasarkan Pencarian Nama (Search)
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(12) 
            ->withQueryString(); // Menjaga filter tetap ada saat pindah halaman (pagination)

        return view('pages.catalog', compact('products', 'categories', 'currentCat'));
    }

    /**
     * 3. DETAIL PRODUK
     */
    public function show(Product $product)
    {
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * 4. HALAMAN LOKASI TOKO
     * Mengarahkan ke view about/lokasi.
     */
    public function lokasi()
    {
        return view('pages.about');
    }

    /**
     * 5. HALAMAN RESELLER
     * Sebelumnya: partnership.blade.php -> Sekarang: reseller.blade.php
     */
    public function resellerPage()
    {
        return view('pages.reseller');
    }

    /**
     * 6. MANAGEMENT KATALOG (ADMIN)
     * Logika untuk file catalog-admin.blade.php agar filter berfungsi.
     */
    public function adminIndex(Request $request)
    {
        $query = Product::query();

        // Filter Nama
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('admin.catalog-admin', compact('products'));
    }
}