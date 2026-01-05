<x-guest-layout>
    {{-- Header Section (Konsisten dengan Tentang Kami) --}}
    <div class="bg-[#004B93] pt-8 pb-16 text-center text-white px-4">
        <h1 class="text-2xl md:text-4xl font-black italic uppercase">Mulai Bisnis Bersama Kami</h1>
        <p class="text-blue-100 mt-2 max-w-xl mx-auto text-sm md:text-base font-medium">
            Jadilah bagian dari Reseller Resmi Alfa Frozen Jaya. Akses harga termurah untuk suplai usaha kuliner Anda dan tingkatkan profit harian.
        </p>
    </div>

    {{-- Content Section --}}
    <div class="max-w-7xl mx-auto px-4 py-16 -mt-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">
            
            {{-- Sisi Kiri: Langkah Pendaftaran --}}
            <div class="lg:col-span-2 space-y-10 py-6">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 leading-tight uppercase italic tracking-tighter">
                        Cara Mudah <br> <span class="text-[#FF2800]">Mulai Reseller</span>
                    </h2>
                    <p class="text-slate-500 mt-4 leading-relaxed font-medium">Proses pendaftaran yang simpel, praktis, dan tanpa biaya tambahan.</p>
                </div>
                
                <div class="space-y-8">
                    @foreach([
                        ['01', 'Daftar & Konsultasi', 'Hubungi kami via WA untuk info paket modal awal yang ringan.'],
                        ['02', 'Terima Katalog Harga', 'Dapatkan daftar harga khusus reseller untuk semua produk.'],
                        ['03', 'Ambil Stok Barang', 'Stok bisa diambil di gerai terdekat atau dikirim ke rumah.'],
                        ['04', 'Mulai Raup Profit', 'Posting produk dan nikmati keuntungan dari setiap penjualan.']
                    ] as $step)
                    <div class="flex gap-6 group">
                        <span class="text-4xl font-black text-slate-200 group-hover:text-[#FF2800] transition duration-300">{{ $step[0] }}</span>
                        <div>
                            <h4 class="font-bold text-slate-800 uppercase text-xs tracking-[0.2em] mb-1">{{ $step[1] }}</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">{{ $step[2] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Sisi Kanan: Formulir (Konsisten dengan Card di Tentang Kami) --}}
            <div class="lg:col-span-3 bg-white rounded-[3rem] shadow-xl border border-slate-100 p-8 md:p-12 relative overflow-hidden">
                {{-- Dekorasi Lingkaran (Aman karena ada overflow-hidden pada parent) --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF2800] opacity-5 rounded-full -mr-16 -mt-16"></div>
                
                <div class="relative z-10">
                    <div class="mb-10">
                        <h3 class="text-2xl font-black text-slate-800 italic uppercase tracking-tight">Formulir Aktivasi</h3>
                        <p class="text-slate-400 text-sm mt-1">Data akan langsung terhubung ke WhatsApp Admin.</p>
                    </div>

                    <form id="resellerForm" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                                <input type="text" id="name" required class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition" placeholder="Sesuai KTP">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Domisili</label>
                                <input type="text" id="location" required class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition" placeholder="Contoh: Cikarang">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori Rencana Jualan</label>
                            <select id="type" required class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition">
                                <option value="">Pilih Kategori</option>
                                <option value="Reseller Rumahan">Reseller Rumahan (Freezer)</option>
                                <option value="Jastip Frozen">Jastip / Pre-Order</option>
                                <option value="Toko Sembako">Warung / Toko Kelontong</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pesan / Pertanyaan</label>
                            <textarea id="note" rows="3" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition" placeholder="Tanyakan paket modal awal..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#FF2800] text-white font-black py-5 rounded-2xl shadow-lg hover:bg-red-700 transition transform active:scale-95 flex items-center justify-center gap-4 group">
                            <i class="fab fa-whatsapp text-2xl group-hover:rotate-12 transition"></i>
                            <span class="tracking-widest italic">HUBUNGI ADMIN VIA WHATSAPP</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resellerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const location = document.getElementById('location').value;
            const type = document.getElementById('type').value;
            const note = document.getElementById('note').value;
            const waNumber = "628123456789"; // Sesuaikan nomor Anda

            const text = `Halo Admin Alfa Frozen Jaya,\n\nSaya ingin mendaftar sebagai *Reseller*.\n\n*Profil Pendaftar:*\n- Nama: *${name}*\n- Domisili: *${location}*\n- Kategori: *${type}*\n\n*Pesan:* ${note}`;
            window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`, '_blank');
        });
    </script>
</x-guest-layout>