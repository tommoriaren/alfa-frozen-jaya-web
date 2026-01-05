<x-guest-layout>
    <div class="bg-[#004B93] pt-12 pb-24 text-center text-white">
        <h1 class="text-2xl font-black italic uppercase">Halo, {{ Auth::user()->name }}</h1>
        <p class="text-xs opacity-70">CABANG PILAR - STAFF ALFA FROZEN JAYA</p>
    </div>

    <div class="max-w-xl mx-auto px-4 -mt-12 pb-10">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-2xl text-center border border-slate-100">
            {{-- Menampilkan Pesan Error/Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-4 text-xs font-bold">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-4 text-xs font-bold text-left">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </div>
            @endif

            <p class="text-[10px] font-black uppercase text-slate-400 italic mb-2">Waktu Server (WIB)</p>
            <p class="text-5xl font-black text-slate-800 mb-8" id="clock">00:00:00</p>

            @if(!$attendance)
                <form action="{{ route('clock.in') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="device_info" class="device_info_field">
                    
                    {{-- Input Foto Selfie --}}
                    <div class="mb-6 bg-slate-50 p-6 rounded-3xl border-2 border-dashed border-slate-200">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-3 tracking-widest">Ambil Foto Selfie</label>
                        <input type="file" name="photo" accept="image/*" capture="user" required 
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700">
                    </div>

                    <button type="submit" class="w-full py-6 bg-[#004B93] text-white rounded-3xl font-black uppercase italic tracking-widest shadow-lg active:scale-95 transition duration-300">
                        Absen Masuk
                    </button>
                </form>
            @elseif($attendance && !$attendance->clock_out)
                <form action="{{ route('clock.out') }}" method="POST">
                    @csrf
                    <input type="hidden" name="device_info" class="device_info_field">
                    <button type="submit" class="w-full py-6 bg-[#FF2800] text-white rounded-3xl font-black uppercase italic tracking-widest shadow-lg active:scale-95 transition duration-300">
                        Absen Pulang
                    </button>
                </form>
            @else
                <div class="py-12 bg-slate-50 rounded-[2rem] border border-slate-100">
                    <i class="fas fa-check-circle text-4xl text-green-400 mb-3"></i>
                    <p class="font-black uppercase italic text-slate-400 tracking-widest">Tugas Hari Ini Selesai</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Jam Realtime
        setInterval(() => {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID', { hour12: false });
        }, 1000);

        // Metadata Perangkat
        document.addEventListener('DOMContentLoaded', function() {
            const info = { browser: navigator.userAgent, platform: navigator.platform };
            document.querySelectorAll('.device_info_field').forEach(el => el.value = JSON.stringify(info));
        });
    </script>
</x-guest-layout>