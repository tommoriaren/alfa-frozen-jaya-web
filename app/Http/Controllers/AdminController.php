<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    // ==========================================
    // 1. DASHBOARD & RINGKASAN (Internal)
    // ==========================================

    /**
     * Dashboard Utama Admin.
     * Mengarah ke: resources/views/pages/admin.blade.php
     */
    public function dashboard()
    {
        $recentProducts = Product::latest()->take(5)->get();
        $recentAttendances = Attendance::with('user')->latest()->take(5)->get();

        // FIX: Memanggil 'pages.admin' sesuai saran penyederhanaan nama file
        return view('pages.admin', compact('recentProducts', 'recentAttendances'));
    }

    /**
     * Dashboard khusus Karyawan.
     * Mengarah ke: resources/views/pages/employee.blade.php
     */
    public function employeeDashboard()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        $myLogs = Attendance::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        // FIX: Memanggil 'pages.employee'
        return view('pages.employee', compact('attendance', 'myLogs'));
    }

    // ==========================================
    // 2. MANAJEMEN PRODUK (CRUD Admin)
    // ==========================================

    public function productIndex(Request $request)
    {
        // Menggunakan query builder agar bisa difilter secara kondisional
        $products = \App\Models\Product::latest()
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->paginate(10)
            ->withQueryString(); // Menjaga parameter filter saat pindah halaman pagination

        return view('pages.catalog-admin', compact('products'));
    }

    public function productCreate()
    {
        return view('pages.product-create');
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name'     => $request->name,
            'category' => $request->category,
            'price'    => $request->price,
            'image'    => $imagePath,
        ]);

        // FIX: Sinkronisasi rute ke admin.product.index
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-edit', compact('product'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'price']);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // FIX: Sinkronisasi rute ke admin.product.index
        return redirect()->route('admin.product.index')->with('success', 'Data produk diperbarui.');
    }

    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        // FIX: Sinkronisasi rute ke admin.product.index
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus.');
    }

// ==========================================
    // 3. SISTEM ABSENSI (Karyawan/Internal)
    // ==========================================

    public function clockIn(Request $request)
    {
        // 1. Validasi input GPS (Opsional tapi disarankan)
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $exists = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah absen masuk hari ini.');
        }

        // 2. Tangkap data IP dan GPS
        Attendance::create([
            'user_id'    => Auth::id(),
            'clock_in'   => now(),
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
            'ip_address' => $request->ip(), // Fungsi bawaan Laravel untuk ambil IP
        ]);

        return back()->with('success', 'Selamat bekerja! Absen masuk berhasil.');
    }

    public function clockOut(Request $request)
    {
        // Tetap tangkap koordinat saat pulang untuk memastikan mereka masih di lokasi
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($attendance && !$attendance->clock_out) {
            $attendance->update([
                'clock_out'      => now(),
                'lat_out'        => $request->latitude,  // Opsional: jika ingin mencatat lokasi pulang
                'lng_out'        => $request->longitude, // Opsional: jika ingin mencatat lokasi pulang
                'ip_address_out' => $request->ip(),       // Opsional
            ]);
            return back()->with('success', 'Terima kasih! Absen pulang berhasil.');
        }

        return back()->with('error', 'Gagal absen pulang atau data tidak ditemukan.');
    }

    public function recap(Request $request)
    {
        // Mengambil query dasar dengan relasi user agar tidak N+1 (Penting untuk optimasi data)
        $query = Attendance::with('user');

        // 1. Filter berdasarkan pencarian nama
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Ambil data dengan pagination (15 data per halaman)
        $attendances = $query->latest()->paginate(15);

        return view('pages.recap', compact('attendances'));
    }

    /**
    * Method placeholder untuk Export CSV
    */
    public function export(Request $request)
    {
        // Untuk sementara kita buat redirect balik, 
        // nanti bisa kita isi dengan logika League\Csv atau FastExcel
        return back()->with('success', 'Fitur export sedang disiapkan.');
    }
}