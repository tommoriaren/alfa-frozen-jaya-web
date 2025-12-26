<x-guest-layout>
    <div class="bg-[#004B93] pt-12 pb-24 px-4 text-center text-white relative overflow-hidden">
        <div class="absolute top-4 right-4 z-20">
            <a href="{{ route('logout.get') }}" 
               class="flex items-center gap-2 bg-white/10 hover:bg-red-500/30 hover:text-red-200 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition duration-300 border border-white/10">
                <i class="fas fa-sign-out-alt"></i>
                Keluar
            </a>
        </div>

        <div class="relative z-10">
            <h1 class="text-2xl font-black italic uppercase">Halo, {{ Auth::user()->name }}</h1>
            <p class="text-blue-200 text-xs uppercase tracking-widest font-bold mt-2">Staff Alfa Frozen Jaya</p>
        </div>
        
        <i class="fas fa-snowflake absolute -right-4 -bottom-4 text-8xl text-white/5 rotate-12"></i>
    </div>

    <div class="max-w-xl mx-auto px-4 -mt-12 pb-20 relative z-10">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-2xl border border-slate-100 text-center">
            <div class="mb-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Waktu Sekarang</p>
                <p class="text-4xl font-black text-slate-800 tracking-tighter" id="clock">00:00:00</p>
                
                <div id="location-status" class="mt-2 text-[9px] font-bold uppercase tracking-wider text-slate-400">
                    <i class="fas fa-map-marker-alt mr-1"></i> Mendeteksi Lokasi...
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @if(!$attendance)
                    <form action="{{ route('clock.in') }}" method="POST" id="attendanceForm">
                        @csrf
                        {{-- Input Hidden untuk GPS --}}
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">
                        
                        <button type="submit" id="btn-submit" disabled class="w-full py-6 bg-slate-300 text-white rounded-3xl font-black uppercase italic tracking-widest shadow-lg transition cursor-not-allowed">
                            Memuat Lokasi...
                        </button>
                    </form>
                @elseif($attendance && !$attendance->clock_out)
                    <form action="{{ route('clock.out') }}" method="POST" id="attendanceForm">
                        @csrf
                        {{-- Input Hidden untuk GPS --}}
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">

                        <button type="submit" id="btn-submit" disabled class="w-full py-6 bg-slate-300 text-white rounded-3xl font-black uppercase italic tracking-widest shadow-lg transition cursor-not-allowed">
                            Memuat Lokasi...
                        </button>
                    </form>
                    <p class="mt-4 text-[10px] font-bold text-green-600 uppercase italic tracking-wider">
                        Anda masuk pada: {{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }}
                    </p>
                @else
                    <div class="py-6 bg-slate-100 text-slate-400 rounded-3xl font-black uppercase italic tracking-widest">
                        Tugas Selesai ✨
                    </div>
                @endif
            </div>
        </div>

        {{-- Riwayat tetap sama --}}
        <div class="mt-8">
            <h3 class="font-black text-slate-800 uppercase italic text-[10px] tracking-widest px-6 mb-4">Riwayat 5 Hari Terakhir</h3>
            <div class="space-y-3">
                @foreach($myLogs as $log)
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center transition hover:shadow-md">
                    <div>
                        <p class="text-[11px] font-bold text-slate-700 uppercase">{{ $log->created_at->format('d M Y') }}</p>
                        <p class="text-[9px] font-black text-green-600 uppercase mt-1 tracking-tighter">In: {{ \Carbon\Carbon::parse($log->clock_in)->format('H:i') }}</p>
                    </div>
                    @if($log->clock_out)
                        <span class="text-[9px] font-black text-red-400 uppercase italic tracking-tighter">Out: {{ \Carbon\Carbon::parse($log->clock_out)->format('H:i') }}</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // 1. Script Jam (Eksisting)
        function updateClock() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID', options);
        }
        setInterval(updateClock, 1000);
        updateClock();

        // 2. Script Geolocation
        const latInput = document.getElementById('lat');
        const lngInput = document.getElementById('lng');
        const btnSubmit = document.getElementById('btn-submit');
        const statusText = document.getElementById('location-status');

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
            } else {
                statusText.innerHTML = "Browser tidak mendukung GPS";
                statusText.classList.replace('text-slate-400', 'text-red-500');
            }
        }

        function showPosition(position) {
            latInput.value = position.coords.latitude;
            lngInput.value = position.coords.longitude;
            
            // Aktifkan tombol dan ubah style kembali ke asli
            btnSubmit.disabled = false;
            
            // Cek apakah ini form masuk atau pulang berdasarkan class warna asli anda
            if (document.querySelector('form').action.includes('in')) {
                btnSubmit.className = "w-full py-6 bg-[#004B93] text-white rounded-3xl font-black uppercase italic tracking-widest shadow-lg shadow-blue-200 active:scale-95 transition";
                btnSubmit.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i> Absen Masuk';
            } else {
                btnSubmit.className = "w-full py-6 bg-[#FF2800] text-white rounded-3xl font-black uppercase italic tracking-widest shadow-lg shadow-red-200 active:scale-95 transition";
                btnSubmit.innerHTML = '<i class="fas fa-sign-out-alt mr-2"></i> Absen Pulang';
            }

            statusText.innerHTML = `<i class="fas fa-check-circle mr-1"></i> Lokasi Terkunci`;
            statusText.classList.replace('text-slate-400', 'text-green-500');
        }

        function showError(error) {
            let msg = "";
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    msg = "Izin GPS ditolak. Aktifkan lokasi!";
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg = "Lokasi tidak ditemukan.";
                    break;
                case error.TIMEOUT:
                    msg = "Waktu deteksi lokasi habis.";
                    break;
                default:
                    msg = "Terjadi kesalahan lokasi.";
            }
            statusText.innerHTML = `<i class="fas fa-exclamation-triangle mr-1"></i> ${msg}`;
            statusText.classList.replace('text-slate-400', 'text-red-500');
        }

        // Jalankan deteksi lokasi saat halaman dimuat
        window.onload = getLocation;
    </script>
</x-guest-layout>