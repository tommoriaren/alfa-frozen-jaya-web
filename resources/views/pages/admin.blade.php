<x-guest-layout>
    <div class="bg-[#004B93] pt-12 pb-24 px-4 text-center text-white relative overflow-hidden">
        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter">Admin Dashboard</h1>
            <p class="text-blue-100 text-sm opacity-90 italic">Pusat Kendali Alfa Frozen Jaya</p>
        </div>
        {{-- Ikon Background Dashboard --}}
        <i class="fas fa-chart-line absolute -right-4 -bottom-4 text-9xl text-white/5 rotate-12"></i>
    </div>

    <div class="max-w-7xl mx-auto px-4 -mt-12 relative z-10 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            
            {{-- Menu: Kelola Katalog --}}
            <a href="{{ route('admin.product.index') }}" class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100 flex items-center justify-between group hover:bg-[#004B93] transition duration-500 relative overflow-hidden">
                
                
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-16 h-16 bg-blue-50 text-[#004B93] rounded-3xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition shadow-inner">
                        <i class="fas fa-store text-3xl"></i>
                    </div>
                    <div>
                        <span class="block font-black text-slate-800 uppercase italic tracking-tight group-hover:text-white text-lg leading-none">Kelola Katalog</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-blue-200">Update Produk & Harga</span>
                    </div>
                </div>
                <i class="fas fa-chevron-right text-slate-200 group-hover:text-white transform group-hover:translate-x-2 transition relative z-10"></i>
            </a>

            {{-- Menu: Rekap Absensi --}}
            <a href="{{ route('admin.recap') }}" class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100 flex items-center justify-between group hover:bg-[#FF2800] transition duration-500 relative overflow-hidden">
                {{-- Ikon Dekoratif Transparan --}}
                <i class="fas fa-user-check absolute -right-4 -bottom-4 text-7xl text-slate-50 group-hover:text-white/10 transition-all duration-500 rotate-12"></i>

                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-16 h-16 bg-red-50 text-[#FF2800] rounded-3xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition shadow-inner">
                        <i class="fas fa-calendar-alt text-3xl"></i>
                    </div>
                    <div>
                        <span class="block font-black text-slate-800 uppercase italic tracking-tight group-hover:text-white text-lg leading-none">Rekap Absensi</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-red-200">Monitoring & Lembur</span>
                    </div>
                </div>
                <i class="fas fa-chevron-right text-slate-200 group-hover:text-white transform group-hover:translate-x-2 transition relative z-10"></i>
            </a>
        </div>

        {{-- Sisa Konten (Produk Terkini & Absensi) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Produk Terkini Section --}}
            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 uppercase italic text-[10px] tracking-widest flex items-center gap-2">
                        <i class="fas fa-box text-blue-500"></i> Produk Terkini
                    </h3>
                    <i class="fas fa-history text-slate-300 text-xs"></i>
                </div>
                {{-- ... konten loop forelse produk tetap sama ... --}}
                <div class="p-4 space-y-3">
                    @forelse($recentProducts as $p)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:shadow-md transition">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/' . $p->image) }}" class="w-10 h-10 rounded-xl object-cover shadow-sm ring-2 ring-white">
                            <span class="text-[11px] font-bold text-slate-700 uppercase italic">{{ $p->name }}</span>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase">{{ $p->updated_at->diffForHumans() }}</span>
                    </div>
                    @empty
                    <p class="py-10 text-center text-slate-400 text-xs italic">Belum ada aktivitas katalog.</p>
                    @endforelse
                </div>
            </div>

            {{-- Absensi Staff Section --}}
            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 uppercase italic text-[10px] tracking-widest flex items-center gap-2">
                        <i class="fas fa-id-badge text-red-500"></i> Absensi Staff
                    </h3>
                    <i class="fas fa-user-clock text-slate-300 text-xs"></i>
                </div>
                {{-- ... konten loop forelse absensi tetap sama ... --}}
                <div class="p-4 space-y-3">
                    @forelse($recentAttendances as $at)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:shadow-md transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#004B93] to-blue-400 text-white rounded-lg flex items-center justify-center text-[10px] font-black shadow-lg">
                                {{ strtoupper(substr($at->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-700 uppercase leading-none">{{ $at->user->name }}</p>
                                <p class="text-[9px] text-green-600 font-black mt-1 uppercase italic flex items-center gap-1">
                                    <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                                    In: {{ \Carbon\Carbon::parse($at->clock_in)->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase italic">{{ $at->created_at->diffForHumans() }}</span>
                    </div>
                    @empty
                    <p class="py-10 text-center text-slate-400 text-xs italic">Belum ada aktivitas hari ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>