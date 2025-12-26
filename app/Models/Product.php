<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// HAPUS BARIS INI: use App\Models\Category;

class Product extends Model
{
    use HasFactory; 
    
    // HAPUS METHOD category() JIKA ADA
    /*
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    */
    
    // ...
}