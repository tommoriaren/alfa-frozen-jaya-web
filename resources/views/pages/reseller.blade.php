<x-guest-layout> 
    <div class="bg-[#004B93] pt-8 pb-16 text-center text-white px-4">
        <h1 class="text-2xl md:text-4xl font-black italic">Harga Khusus Stokis: Jualan Laris, Untung Maksimal!</h1>
        <p class="text-blue-100 mt-2 max-w-xl mx-auto text-sm md:text-base">
            Jadilah bagian dari Reseller Resmi Alfa Frozen Jaya. Akses harga termurah untuk suplai usaha kuliner Anda dan tingkatkan profit harian tanpa ribet.
        </p>
    </div>

    <section class="max-w-7xl mx-auto px-4 py-16 -mt-8 relative z-20">
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