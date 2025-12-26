<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/katalog', [PageController::class, 'katalog'])->name('catalog');
Route::get('/produk/{product:slug}', [PageController::class, 'show'])->name('product.show');
Route::get('/tentang-kami', [PageController::class, 'lokasi'])->name('about');
Route::get('/reseller', [PageController::class, 'resellerPage'])->name('reseller');

/*
|--------------------------------------------------------------------------
| 2. RUTE TERPROTEKSI (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    /**
     * DASHBOARD SMART REDIRECT
     * Mengarahkan user ke rute yang tepat segera setelah login.
     */
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'karyawan') {
            return redirect()->route('employee.dashboard');
        }

        return redirect('/')->with('error', 'Role tidak terdaftar.');
    })->name('dashboard');

    /**
     * MANAJEMEN PROFIL (Bisa diakses semua role)
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |----------------------------------------------------------------------
    | 3. KHUSUS ADMIN (Middleware: admin)
    |----------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {
        
        // Dashboard Utama Admin
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Rekap Absensi
        Route::get('/admin/recap', [AdminController::class, 'recap'])->name('admin.recap');
        Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

        // CRUD Produk (Prefix Name: admin.product.)
        Route::prefix('admin/produk')->name('admin.product.')->group(function () {
            Route::get('/', [AdminController::class, 'productIndex'])->name('index');         // admin.product.index
            Route::get('/tambah', [AdminController::class, 'productCreate'])->name('create'); // admin.product.create
            Route::post('/simpan', [AdminController::class, 'productStore'])->name('store');
            Route::get('/{id}/edit', [AdminController::class, 'productEdit'])->name('edit');
            Route::patch('/{id}/update', [AdminController::class, 'productUpdate'])->name('update');
            Route::delete('/{id}/hapus', [AdminController::class, 'productDestroy'])->name('destroy');
        });
    });

    /*
    |----------------------------------------------------------------------
    | 4. KHUSUS KARYAWAN (Middleware: employee/karyawan)
    |----------------------------------------------------------------------
    */
    Route::middleware(['employee'])->group(function () {
        // Dashboard Utama Karyawan
        Route::get('/staff/dashboard', [AdminController::class, 'employeeDashboard'])->name('employee.dashboard');
        
        // Aksi Absensi
        Route::post('/staff/absensi/masuk', [AdminController::class, 'clockIn'])->name('clock.in');
        Route::post('/staff/absensi/pulang', [AdminController::class, 'clockOut'])->name('clock.out');
    });
});

/*
|--------------------------------------------------------------------------
| 5. LOGOUT (GET Method untuk memudahkan testing di Redmi Note 7)
|--------------------------------------------------------------------------
*/
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout.get');

require __DIR__.'/auth.php';