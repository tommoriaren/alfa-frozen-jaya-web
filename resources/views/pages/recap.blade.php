<x-guest-layout>
    <div class="bg-[#004B93] pt-12 pb-20 px-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-white">
                <h1 class="text-3xl font-black italic uppercase tracking-tighter">Attendance Recap</h1>
                <p class="text-blue-200 text-sm">Monitoring kehadiran dan jam lembur staff Alfa Frozen Jaya</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-2xl font-bold text-xs transition border border-white/20 uppercase tracking-widest">
                ← Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 -mt-10 pb-20">
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-8 mb-8">
            <form action="{{ route('admin.recap') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Cari Nama Karyawan</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: Budi..." 
                           class="w-full bg-slate-50 border-none rounded-xl py-3.5 px-4 text-xs focus:ring-2 focus:ring-[#004B93] mt-1">
                </div>
                
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                           class="w-full bg-slate-50 border-none rounded-xl py-3.5 px-4 text-xs focus:ring-2 focus:ring-[#004B93] mt-1">
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" 
                           class="w-full bg-slate-50 border-none rounded-xl py-3.5 px-4 text-xs focus:ring-2 focus:ring-[#004B93] mt-1">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-[#004B93] text-white font-black py-4 rounded-xl text-[10px] uppercase tracking-widest hover:bg-blue-800 transition shadow-md">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <a href="{{ route('admin.recap') }}" class="bg-slate-100 text-slate-400 p-4 rounded-xl hover:bg-slate-200 transition border border-slate-200">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                    Menampilkan data: <span class="text-slate-700 italic">{{ request('start_date') ?? 'Semua' }}</span> s/d <span class="text-slate-700 italic">{{ request('end_date') ?? 'Sekarang' }}</span>
                </p>
                <a href="{{ route('admin.export', request()->all()) }}" 
                   class="bg-[#25D366] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-green-600 transition shadow-lg flex items-center gap-2">
                    <i class="fas fa-file-csv text-sm"></i> Export CSV Berdasarkan Filter
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-400 font-black uppercase tracking-widest border-b">
                        <tr>
                            <th class="px-8 py-6">Karyawan</th>
                            <th class="px-8 py-6 text-center">Tanggal</th>
                            <th class="px-8 py-6 text-center">Clock In</th>
                            <th class="px-8 py-6 text-center">Clock Out</th>
                            <th class="px-8 py-6 text-center">Total Jam</th>
                            <th class="px-8 py-6 text-right">Lembur</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($attendances as $at)
                        @php
                            $totalHours = 0;
                            $overtime = 0;
                            if($at->clock_in && $at->clock_out) {
                                $in = \Carbon\Carbon::parse($at->clock_in);
                                $out = \Carbon\Carbon::parse($at->clock_out);
                                $totalHours = $in->diffInHours($out);
                                $overtime = $totalHours > 8 ? $totalHours - 8 : 0;
                            }
                        @endphp
                        <tr class="hover:bg-slate-50 transition duration-200">
                            <td class="px-8 py-5">
                                <p class="font-black text-slate-800 uppercase italic tracking-tight">{{ $at->user->name }}</p>
                                <p class="text-[9px] text-slate-400 font-bold uppercase">{{ $at->user->role }}</p>
                            </td>
                            <td class="px-8 py-5 text-center font-medium text-slate-500 uppercase">
                                {{ \Carbon\Carbon::parse($at->created_at)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg font-black tracking-tighter">
                                    {{ $at->clock_in ? \Carbon\Carbon::parse($at->clock_in)->format('H:i') : '--:--' }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="bg-slate-50 text-slate-400 px-3 py-1.5 rounded-lg font-black tracking-tighter">
                                    {{ $at->clock_out ? \Carbon\Carbon::parse($at->clock_out)->format('H:i') : '--:--' }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center font-black text-slate-700 italic">
                                {{ $totalHours }} Jam
                            </td>
                            <td class="px-8 py-5 text-right">
                                @if($overtime > 0)
                                    <span class="text-[#FF2800] font-black italic">+{{ $overtime }} Jam</span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center text-slate-400 italic font-bold uppercase tracking-widest">
                                Tidak ada data absensi yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($attendances->hasPages())
                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>