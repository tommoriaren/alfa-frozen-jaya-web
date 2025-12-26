<x-guest-layout>
    <section class="relative bg-gradient-to-b from-[#004B93] to-[#00366d] pt-20 pb-24 text-center text-white px-4 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48ZyBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0wIDQwaDQwVjBIMHY0MHptMjAgMjBWMjBoMjB2MjBIMjB6TTIwIDIwVjBoMjB2MjBIMjB6IiBmaWxsPSIjRkYyODAwIi8+PC9nPjwvc3ZnPg==');"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-black italic mb-6 leading-[0.95] tracking-tighter">
                Freezer di Rumah, <br> 
                <span class="text-white/80">Jadi Peluang Usaha Keluarga</span>
            </h1>
            <p class="text-blue-100 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto font-medium opacity-90">
                Mulai usaha kuliner dari rumah. Jadilah Reseller resmi Alfa Frozen Jaya dan dapatkan harga khusus stokis untuk keuntungan harian yang maksimal.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-16 -mt-20 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            <div class="bg-white p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 text-center group hover:bg-[#FF2800] transition-all duration-500">
                <div class="text-5xl mb-6 group-hover:scale-110 transition duration-500">💰</div>
                <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-white transition">Harga Khusus Reseller</h3>
                <p class="text-slate-500 text-sm leading-relaxed group-hover:text-red-50 transition">Dapatkan potongan harga langsung tanpa minimum order tinggi agar margin keuntungan Anda tetap tebal.</p>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 text-center group hover:bg-[#004B93] transition-all duration-500">
                <div class="text-5xl mb-6 group-hover:scale-110 transition duration-500">📸</div>
                <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-white transition">Konten Siap Jualan</h3>
                <p class="text-slate-500 text-sm leading-relaxed group-hover:text-blue-50 transition">Tidak perlu bingung desain. Kami sediakan foto produk dan materi promosi WhatsApp agar Anda tinggal posting saja.</p>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 text-center group hover:bg-[#004B93] transition-all duration-500">
                <div class="text-5xl mb-6 group-hover:scale-110 transition duration-500">🤝</div>
                <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-white transition">Panduan Jualan Laris</h3>
                <p class="text-slate-500 text-sm leading-relaxed group-hover:text-blue-50 transition">Tim kami siap membimbing cara berjualan frozen food bagi pemula agar perputaran stok di rumah Anda cepat.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-16 items-start">
            <div class="lg:col-span-2 space-y-10 py-6">
                <div>
                    <h2 class="text-4xl font-black text-slate-800 leading-tight uppercase italic tracking-tighter">
                        Cara Mudah <br> <span class="text-[#FF2800]">Mulai Reseller</span>
                    </h2>
                    <p class="text-slate-500 mt-4 leading-relaxed">Proses pendaftaran reseller yang simpel, praktis, dan tanpa biaya pendaftaran tambahan.</p>
                </div>
                
                <div class="space-y-8">
                    @foreach([
                        ['01', 'Daftar & Konsultasi', 'Hubungi kami via WA untuk info paket modal awal yang ringan di kantong.'],
                        ['02', 'Terima Katalog Harga', 'Kami berikan daftar harga khusus reseller untuk semua jenis produk frozen food.'],
                        ['03', 'Ambil Stok Barang', 'Silakan ambil stok di gerai terdekat atau dikirim langsung ke alamat rumah Anda.'],
                        ['04', 'Mulai Raup Profit', 'Posting produk di grup WA atau sosmed, dan nikmati keuntungan dari setiap penjualan.']
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

            <div class="lg:col-span-3 bg-white rounded-[3rem] shadow-2xl border border-slate-100 p-8 md:p-12 relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF2800] opacity-5 rounded-full -mr-16 -mt-16"></div>
                
                <div class="mb-10 text-center md:text-left">
                    <h3 class="text-2xl font-black text-slate-800 italic uppercase tracking-tight">Pendaftaran Reseller</h3>
                    <p class="text-slate-400 text-sm mt-1">Isi formulir untuk aktivasi akun reseller Anda.</p>
                </div>

                <form id="resellerForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" id="name" required class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition" placeholder="Sesuai KTP">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                            <input type="text" id="location" required class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition" placeholder="Contoh: Perumahan Cikarang">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori Usaha</label>
                        <select id="type" required class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition">
                            <option value="">Pilih Rencana Jualan</option>
                            <option value="Reseller Rumahan">Reseller Rumahan (Punya Freezer Sendiri)</option>
                            <option value="Jastip Frozen">Jastip / Pre-Order</option>
                            <option value="Toko Sembako">Toko Sembako / Warung Kelontong</option>
                            <option value="UMKM Olahan">UMKM (Bahan Baku Masakan)</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanya Paket Reseller</label>
                        <textarea id="note" rows="3" class="w-full bg-slate-50 border-slate-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-[#004B93] focus:border-[#004B93] transition" placeholder="Contoh: Berapa minimum order untuk dapat harga reseller?"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#FF2800] text-white font-black py-5 rounded-2xl shadow-[0_15px_30px_rgba(255,40,0,0.3)] hover:bg-red-700 transition transform active:scale-95 flex items-center justify-center gap-4 group">
                        <i class="fab fa-whatsapp text-2xl group-hover:rotate-12 transition"></i>
                        <span class="tracking-widest italic">DAFTAR RESELLER SEKARANG</span>
                    </button>
                    
                    <p class="text-center text-[10px] text-slate-400 font-medium">Data pendaftaran akan diverifikasi oleh tim admin kami via WhatsApp.</p>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('resellerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const location = document.getElementById('location').value;
            const type = document.getElementById('type').value;
            const note = document.getElementById('note').value;
            const waNumber = "{{ env('STORE_WA_NUMBER') }}"; 

            const text = `Halo Admin Alfa Frozen Jaya,\n\nSaya ingin mendaftar sebagai *Reseller Official*.\n\n*Profil Pendaftar:*\n- Nama: *${name}*\n- Domisili: *${location}*\n- Kategori: *${type}*\n\n*Pertanyaan:* ${note}\n\nMohon petunjuk pendaftaran selanjutnya. Terima kasih!`;
            
            const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`;
            window.open(waUrl, '_blank');
        });
    </script>
</x-guest-layout>