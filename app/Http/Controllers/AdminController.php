<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    // ==========================================
    // 1. DASHBOARD & RINGKASAN
    // ==========================================

    public function dashboard()
    {
        $recentProducts = Product::latest()->take(5)->get();
        $recentAttendances = Attendance::with('user')->latest()->take(5)->get();

        return view('pages.admin', compact('recentProducts', 'recentAttendances'));
    }

    public function employeeDashboard()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        $myLogs = Attendance::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('pages.employee', compact('attendance', 'myLogs'));
    }

    // ==========================================
    // 2. MANAJEMEN PRODUK (CRUD)
    // ==========================================

    public function productIndex(Request $request)
    {
        // Membangun query dasar
        $query = Product::query();

        // Filter 1: Pencarian Nama (Jika ada input 'search')
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter 2: Kategori (Jika ada input 'category')
        // Ini adalah bagian krusial yang memastikan filter kategori bekerja
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Eksekusi query dengan urutan terbaru dan pagination
        $products = $query->latest()
            ->paginate(10)
            ->withQueryString(); // Menjaga parameter filter tetap ada saat pindah halaman (pagination)

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

        return redirect()->route('admin.product.index')->with('success', 'Data produk diperbarui.');
    }

    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus.');
    }

    // ==========================================
    // 3. SISTEM ABSENSI (GPS Validation & WebP)
    // ==========================================

    public function clockIn(Request $request)
{
    $request->validate([
        'photo' => 'required|image|max:2048',
    ]);

    $imagePath = $request->file('photo')->getRealPath();

    // Cek GPS tapi JANGAN gagalkan proses jika tidak ada
    $exif = @exif_read_data($imagePath);
    $locationData = "Lokasi Tidak Terdeteksi";
    
    if ($exif && isset($exif['GPSLatitude'])) {
        $locationData = "Lokasi Tersemat di Foto";
    }

    // Tetap proses simpan agar karyawan tidak kesal karena error teknis
    $filename = 'att_' . time() . '.webp';
    $manager = new ImageManager(new Driver());
    $image = $manager->read($imagePath);
    $encoded = $image->toWebp(80); 

    Storage::disk('public')->put('attendance/' . $filename, $encoded);

    Attendance::create([
        'user_id'     => Auth::id(),
        'clock_in'    => now(),
        'device_info' => $request->header('User-Agent'),
        'photo'       => 'attendance/' . $filename,
        'note'        => $locationData // Simpan status GPS di kolom catatan
    ]);

    return back()->with('success', 'Absen Berhasil! Semangat bekerja.');
}

    public function clockOut(Request $request)
{
    // 1. Cari data absensi hari ini milik user yang sedang login
    $attendance = Attendance::where('user_id', Auth::id())
        ->whereDate('created_at', Carbon::today())
        ->first();

    // 2. Validasi: Apakah karyawan sudah absen masuk?
    if (!$attendance) {
        return back()->with('error', 'Gagal! Anda belum melakukan Absen Masuk hari ini.');
    }

    // 3. Validasi: Apakah sudah absen pulang sebelumnya?
    if ($attendance->clock_out) {
        return back()->with('error', 'Anda sudah melakukan Absen Pulang hari ini.');
    }

    // 4. Proses Update Jam Pulang
    $attendance->update([
        'clock_out' => now(),
        'device_info' => $request->header('User-Agent'), // Update info perangkat terakhir
    ]);

    return back()->with('success', 'Absen Pulang Berhasil. Hati-hati di jalan!');
}

    public function recap(Request $request)
    {
        $query = Attendance::with('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $attendances = $query->latest()->paginate(15);

        $attendances->getCollection()->transform(function ($item) {
            if ($item->clock_in && $item->clock_out) {
                $in = Carbon::parse($item->clock_in);
                $out = Carbon::parse($item->clock_out);
                $item->duration = $in->diff($out)->format('%Hj %Im');
            } else {
                $item->duration = 'Aktif';
            }
            return $item;
        });

        return view('pages.recap', compact('attendances'));
    }

    public function export(Request $request)
    {
        return back()->with('success', 'Fitur export sedang disiapkan.');
    }
}