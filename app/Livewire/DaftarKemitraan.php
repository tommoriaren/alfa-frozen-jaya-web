<?php

namespace App\Livewire;

use Livewire\Component;

class DaftarKemitraan extends Component
{
    // Properti untuk menampung input form
    public $nama = '';
    public $telepon = '';
    public $area = '';
    public $minat = '';
    public $successMessage = '';

    // Aturan validasi
    protected $rules = [
        'nama' => 'required|min:3',
        'telepon' => 'required|numeric|digits_between:10,14',
        'area' => 'required|min:5',
        'minat' => 'required',
    ];

    public function submitForm()
    {
        // 1. Validasi input
        $this->validate();

        // 2. Logika Bisnis (Simpan ke DB, Kirim Email, dll.)
        
        // Contoh: Simpan ke database (jika ada model Mitra)
        // Mitra::create([
        //     'nama' => $this->nama,
        //     'telepon' => $thiss->telepon,
        //     'area' => $this->area,
        //     'minat' => $this->minat,
        // ]);

        // 3. Reset input dan tampilkan pesan sukses
        $this->reset(['nama', 'telepon', 'area', 'minat']);
        $this->successMessage = 'Pendaftaran Anda berhasil dikirim! Tim kami akan menghubungi Anda dalam 1x24 jam.';
    }

    public function render()
    {
        return view('livewire.daftar-kemitraan');
    }
}