<x-guest-layout>
    <div class="bg-[#004B93] pt-12 pb-24 px-4 text-center text-white relative overflow-hidden">
        <div class="absolute top-4 right-4 z-20">
            <a href="{{ route('logout.get') }}" 
               class="flex items-center gap-2 bg-white/10 hover:bg-red-500/30 hover:text-red-200 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition duration-300 border border-white/10">
                <i class="fas fa-sign-out-alt"></i>
                Keluar
            </a>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter">Admin Dashboard</h1>
            <p class="text-blue-100 text-sm opacity-90 italic">Pusat Kendali Alfa Frozen Jaya</p>
        </div>
        <i class="fas fa-tools absolute -right-4 -bottom-4 text-8xl text-white/5 rotate-12"></i>
    </div>

    <div class="max-w-7xl mx-auto px-4 -mt-12 relative z-10 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <a href="{{ route('admin.product.index') }}" class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100 flex items-center justify-between group hover:bg-[#004B93] transition duration-500">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 bg-blue-50 text-[#004B93] rounded-3xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition shadow-inner">
                        <i class="fas fa-boxes text-3xl"></i>
                    </div>
                    <div>
                        <span class="block font-black text-slate-800 uppercase italic tracking-tight group-hover:text-white text-lg leading-none">Kelola Katalog</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-blue-200">Update Produk & Harga</span>
                    </div>
                </div>
                <i class="fas fa-chevron-right text-slate-200 group-hover:text-white transform group-hover:translate-x-2 transition"></i>
            </a>

            <a href="{{ route('admin.recap') }}" class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100 flex items-center justify-between group hover:bg-[#FF2800] transition duration-500">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 bg-red-50 text-[#FF2800] rounded-3xl flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition shadow-inner">
                        <i class="fas fa-clipboard-check text-3xl"></i>
                    </div>
                    <div>
                        <span class="block font-black text-slate-800 uppercase italic tracking-tight group-hover:text-white text-lg leading-none">Rekap Absensi</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-red-200">Monitoring & Lembur</span>
                    </div>
                </div>
                <i class="fas fa-chevron-right text-slate-200 group-hover:text-white transform group-hover:translate-x-2 transition"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 uppercase italic text-[10px] tracking-widest">Produk Terkini</h3>
                    <i class="fas fa-history text-slate-300 text-xs"></i>
                </div>
                <div class="p-4 space-y-3">
                    @forelse($recentProducts as $p)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/' . $p->image) }}" class="w-10 h-10 rounded-xl object-cover shadow-sm">
                            <span class="text-[11px] font-bold text-slate-700 uppercase italic">{{ $p->name }}</span>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase">{{ $p->updated_at->diffForHumans() }}</span>
                    </div>
                    @empty
                    <p class="py-10 text-center text-slate-400 text-xs italic">Belum ada aktivitas katalog.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 uppercase italic text-[10px] tracking-widest">Absensi Staff</h3>
                    <i class="fas fa-user-clock text-slate-300 text-xs"></i>
                </div>
                <div class="p-4 space-y-3">
                    @forelse($recentAttendances as $at)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#004B93] text-white rounded-lg flex items-center justify-center text-[10px] font-black">
                                {{ strtoupper(substr($at->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-700 uppercase leading-none">{{ $at->user->name }}</p>
                                <p class="text-[9px] text-green-600 font-black mt-1 uppercase italic">In: {{ \Carbon\Carbon::parse($at->clock_in)->format('H:i') }}</p>
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