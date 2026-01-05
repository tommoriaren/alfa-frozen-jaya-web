<x-guest-layout>
    {{-- Header Section --}}
    <div class="bg-[#004B93] pt-12 pb-24 px-4 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black italic uppercase tracking-tighter">Attendance Recap</h1>
                <p class="text-blue-100 text-sm opacity-90 italic">Monitoring absensi dan durasi kerja staff</p>
            </div>
            
            {{-- Tombol Kembali ke Dashboard Admin --}}
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-2xl font-black uppercase italic text-[10px] tracking-widest border border-white/20 transition-all shadow-sm w-fit">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
        {{-- Ikon dekoratif background --}}
        <i class="fas fa-clipboard-list absolute -right-4 -bottom-4 text-9xl text-white/5 rotate-12"></i>
    </div>

    <div class="max-w-7xl mx-auto px-4 -mt-12 relative z-10 pb-20">
        {{-- Filter & Search Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-xl p-8 mb-8 border border-slate-100">
            <form action="{{ route('admin.recap') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 italic ml-2">Cari Nama</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama staff..." 
                           class="w-full bg-slate-50 border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-[#004B93] py-3 px-5">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 italic ml-2">Mulai Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                           class="w-full bg-slate-50 border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-[#004B93] py-3 px-5">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 italic ml-2">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" 
                           class="w-full bg-slate-50 border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-[#004B93] py-3 px-5">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-[#004B93] text-white font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-blue-800 transition shadow-md">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>

                    <a href="{{ route('admin.recap') }}" class="flex-1 bg-slate-100 text-slate-400 font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-slate-200 transition border border-slate-200 text-center">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr class="text-[10px] font-black uppercase text-slate-400 tracking-widest italic">
                            <th class="px-8 py-6">Karyawan</th>
                            <th class="px-8 py-6 text-center">Bukti Selfie</th>
                            <th class="px-8 py-6 text-center text-[#004B93]">Clock In</th>
                            <th class="px-8 py-6 text-center text-[#FF2800]">Clock Out</th>
                            <th class="px-8 py-6 text-center">Durasi</th>
                            <th class="px-8 py-6 text-right">Perangkat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($attendances as $at)
                        <tr class="hover:bg-slate-50/50 transition duration-300">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#004B93] to-blue-400 text-white rounded-xl flex items-center justify-center font-black text-xs shadow-md">
                                        {{ strtoupper(substr($at->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 uppercase italic leading-none">{{ $at->user->name }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold mt-1 uppercase">{{ \Carbon\Carbon::parse($at->created_at)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-6 text-center">
                                @if($at->photo)
                                    <div class="relative inline-block group cursor-zoom-in" onclick="openPreview('{{ asset('storage/' . $at->photo) }}')">
                                        <img src="{{ asset('storage/' . $at->photo) }}" 
                                             class="w-14 h-14 rounded-2xl object-cover mx-auto shadow-md ring-2 ring-white group-hover:ring-[#004B93] transition-all">
                                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 rounded-2xl transition flex items-center justify-center text-white text-[8px] font-black uppercase italic">
                                            Lihat
                                        </div>
                                    </div>
                                @else
                                    <span class="text-[9px] font-black text-slate-300 italic">TANPA FOTO</span>
                                @endif
                            </td>

                            <td class="px-8 py-6 text-center font-black text-slate-700">
                                <span class="bg-blue-50 text-[#004B93] px-3 py-1.5 rounded-lg text-[10px]">
                                    {{ $at->clock_in ? \Carbon\Carbon::parse($at->clock_in)->format('H:i') : '--:--' }}
                                </span>
                            </td>

                            <td class="px-8 py-6 text-center font-black text-slate-700">
                                <span class="bg-red-50 text-[#FF2800] px-3 py-1.5 rounded-lg text-[10px]">
                                    {{ $at->clock_out ? \Carbon\Carbon::parse($at->clock_out)->format('H:i') : '--:--' }}
                                </span>
                            </td>

                            <td class="px-8 py-6 text-center">
                                <div class="inline-flex items-center gap-1.5 bg-slate-100 px-3 py-1.5 rounded-full">
                                    <i class="fas fa-hourglass-half text-[8px] text-slate-400"></i>
                                    <span class="font-black italic text-slate-700 text-[10px]">{{ $at->duration }}</span>
                                </div>
                            </td>

                            <td class="px-8 py-6 text-right">
                                <div class="text-[9px] text-slate-400 font-bold uppercase leading-tight italic">
                                    @php $device = json_decode($at->device_info); @endphp
                                    <p>{{ $device->platform ?? 'Unknown' }}</p>
                                    <p class="text-[8px] opacity-60">ID: #{{ $at->id }}</p>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <i class="fas fa-folder-open text-5xl text-slate-100 mb-4"></i>
                                <p class="text-slate-400 text-xs font-bold uppercase italic">Data absensi tidak ditemukan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($attendances->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Preview Foto --}}
    <div id="imageModal" class="fixed inset-0 z-[100] hidden bg-black/90 backdrop-blur-sm items-center justify-center p-4" onclick="closePreview()">
        <div class="relative max-w-lg w-full">
            <img id="modalImage" src="" class="w-full h-auto rounded-3xl shadow-2xl border-4 border-white/10">
        </div>
    </div>

    <script>
        function openPreview(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closePreview() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-guest-layout>