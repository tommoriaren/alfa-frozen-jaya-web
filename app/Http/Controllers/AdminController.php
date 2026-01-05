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
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
        ], [
            // Pesan error kustom dalam bahasa Indonesia
            'photo.required' => 'Foto selfie wajib diunggah.',
            'photo.image'    => 'File harus berupa gambar.',
            'photo.mimes'    => 'Format foto harus JPEG, PNG, JPG, atau WebP.',
            'photo.max'      => 'Ukuran foto terlalu besar, maksimal 2MB.',
        ]);

        $imagePath = $request->file('photo')->getRealPath();

        // 1. VALIDASI GPS (EXIF DATA)
        $exif = @exif_read_data($imagePath);
        if (!$exif || !isset($exif['GPSLatitude'], $exif['GPSLongitude'])) {
            return back()->with('error', 'Gagal! Foto tidak memiliki data lokasi. Pastikan GPS HP aktif saat mengambil foto.');
        }

        // 2. CEK APAKAH SUDAH ABSEN HARI INI
        $exists = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah absen masuk hari ini.');
        }

        // 3. KONVERSI KE WEBP (LIBRARY INTERVENTION)
        $filename = 'att_' . time() . '.webp';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($imagePath);
        $encoded = $image->toWebp(80); // Kompresi 80%

        Storage::disk('public')->put('attendance/' . $filename, $encoded);

        // 4. SIMPAN KE DATABASE
        Attendance::create([
            'user_id'     => Auth::id(),
            'clock_in'    => now(),
            'device_info' => $request->device_info,
            'photo'       => 'attendance/' . $filename,
        ]);

        return back()->with('success', 'Absen masuk berhasil! Foto dikompres ke WebP.');
    }

    public function clockOut(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($attendance && !$attendance->clock_out) {
            $attendance->update([
                'clock_out'   => now(),
                'device_info' => $request->device_info,
            ]);
            return back()->with('success', 'Absen pulang berhasil!');
        }

        return back()->with('error', 'Data tidak ditemukan.');
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