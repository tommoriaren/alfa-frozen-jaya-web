<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Properti $fillable menentukan kolom mana saja yang boleh diisi
     * melalui form (Mass Assignment). Tanpa memasukkan 'category' di sini,
     * data kategori tidak akan tersimpan ke database.
     */
    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
    ];

    /**
     * Opsional: Helper untuk memformat harga ke Rupiah
     * Anda bisa memanggil ini di Blade dengan: {{ $product->formatted_price }}
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}