<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 👇 RELASI KE USER
    // Supaya kita bisa panggil $attendance->user->name di Export Excel
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}