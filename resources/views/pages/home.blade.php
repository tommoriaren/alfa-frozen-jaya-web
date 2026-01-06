<x-guest-layout>
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <section class="bg-[#004B93] pt-16 pb-24 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center relative z-10 gap-12">
            {{-- Bagian Teks (Kiri) --}}
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="font-black italic leading-[0.9] text-white tracking-tighter mb-6">
                    <span class="text-4xl md:text-7xl block mb-2">
                        Alfa Frozen Jaya
                    </span>
    
                    <span class="text-xl md:text-3xl text-[#FF2800] block mt-2 uppercase tracking-normal">
                        Lebih Lengkap, Lebih Hemat
                    </span>
                </h1>
                <p class="text-blue-100 text-sm md:text-lg mb-10 max-w-lg mx-auto md:mx-0 leading-relaxed font-medium">
                    Kualitas teruji dari brand ternama. Kami pastikan suhu terjaga hingga ke tangan Anda. Khusus area Cikarang & sekitarnya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('catalog') }}" class="bg-[#FF2800] text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-2xl shadow-red-500/40 hover:translate-y-[-4px] transition-all duration-300 active:scale-95 text-center">
                        Buka Katalog
                    </a>
                    <a href="{{ route('reseller') }}" class="bg-white text-[#004B93] border-2 border-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-transparent hover:text-white transition-all duration-300 text-center">
                        Info Reseller
                    </a>
                </div>
            </div>

            {{-- Bagian Carousel (Kanan) --}}
            <div class="md:w-1/2 w-full">
                <div class="swiper myHeroSwiper rounded-[3rem] shadow-2xl border-4 border-white/10 overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('images/carousel1.webp') }}" class="w-full h-[300px] md:h-[450px] object-cover">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/carousel2.webp') }}" class="w-full h-[300px] md:h-[450px] object-cover">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/carousel3.webp') }}" class="w-full h-[300px] md:h-[450px] object-cover">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/carousel4.webp') }}" class="w-full h-[300px] md:h-[450px] object-cover">
                        </div>
                    </div>
                    {{-- Navigasi Bulat --}}
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        {{-- Ikon Dekorasi Salju --}}
        <i class="fas fa-snowflake absolute -right-10 -bottom-10 text-9xl text-white/5 rotate-12"></i>
    </section>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.myHeroSwiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            effect: 'creative',
            creativeEffect: {
                prev: { translate: [0, 0, -400], opacity: 0 },
                next: { translate: ['100%', 0, 0] },
            },
        });
    </script>

    <section class="bg-slate-50 py-16 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-start gap-4 p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600">🚀</div>
                <div>
                    <h4 class="font-black uppercase italic text-xs text-slate-800 mb-1">Kirim Cepat</h4>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Satu hari sampai area Cikarang.</p>
                </div>
            </div>
            <div class="flex items-start gap-4 p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="bg-red-50 p-3 rounded-2xl text-2xl text-red-600">✅</div>
                <div>
                    <h4 class="font-black uppercase italic text-xs text-slate-800 mb-1">100% Halal</h4>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Produk bersertifikasi & higienis.</p>
                </div>
            </div>
            <div class="flex items-start gap-4 p-6 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="bg-green-50 p-3 rounded-2xl text-2xl text-green-600">💰</div>
                <div>
                    <h4 class="font-black uppercase italic text-xs text-slate-800 mb-1">Harga Grosir</h4>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Lebih hemat untuk konsumsi rutin.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 pb-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between mb-10">
                <div class="space-y-2">
                    <span class="text-[#FF2800] font-black text-[10px] uppercase tracking-[0.4em]">Highlight</span>
                    <h2 class="text-3xl md:text-4xl font-black italic uppercase text-slate-900 leading-none tracking-tighter">Produk Unggulan</h2>
                </div>
                <a href="{{ route('catalog') }}" class="hidden md:block text-[11px] font-black uppercase text-[#004B93] border-b-2 border-[#004B93] pb-1 hover:text-[#FF2800] hover:border-[#FF2800] transition-all">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                @foreach($products as $product)
                <article class="bg-white rounded-[2.5rem] p-3 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col group">
                    <div class="aspect-square bg-slate-50 rounded-[2rem] overflow-hidden relative mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-[#004B93] text-[8px] font-black px-2.5 py-1.5 rounded-xl uppercase tracking-tighter shadow-sm">
                            {{ $product->category }}
                        </span>
                    </div>

                    <div class="px-2 flex flex-col flex-grow">
                        <h3 class="text-xs md:text-sm font-black text-slate-800 uppercase italic leading-tight mb-2 line-clamp-2 h-8 group-hover:text-[#004B93]">
                            {{ $product->name }}
                        </h3>
                        
                        <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-sm md:text-lg font-black text-[#FF2800] italic">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            
                            <a href="{{ route('catalog') }}" class="w-9 h-9 bg-[#004B93] text-white rounded-xl flex items-center justify-center shadow-lg active:scale-90 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-12 md:hidden">
                <a href="{{ route('catalog') }}" class="block w-full text-center bg-white border-2 border-[#004B93] text-[#004B93] py-4 rounded-2xl font-black uppercase text-xs tracking-widest">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

<section class="py-20 bg-slate-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black italic text-slate-800 uppercase tracking-tighter">Kepuasan Pelanggan</h2>
            <div class="flex justify-center items-center gap-2 mt-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Google_Maps_icon_%282020%29.svg" class="w-5 h-5" alt="Google Maps">
                <span class="text-sm font-bold text-slate-500 uppercase tracking-widest">Ulasan Asli di Google Maps</span>
            </div>
        </div>

        <div class="swiper testiSwiper">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="bg-white p-2 rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden transform hover:-rotate-1 transition duration-500">
                            <img src="{{ asset('images/ulasan1.webp') }}" alt="Ulasan Neng April" class="rounded-[2rem] w-full object-cover">
                        </div>
                        <div class="space-y-6 lg:pl-6 text-left">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <h3 class="text-3xl font-black text-slate-800 italic leading-tight uppercase">"Stock Nugget Komplit & Parkir Luas"</h3>
                            <p class="text-slate-600 text-lg leading-relaxed font-medium">
                                Seperti yang disampaikan <strong>Neng April</strong>, kami menyediakan berbagai merk nugget lengkap dengan pelayanan staf yang ramah dan sopan untuk membantu Anda memilih produk terbaik.
                            </p>
                            <div class="pt-4">
                                <a href="https://maps.app.goo.gl/ChIJDxX7IwubaS4R5V98VPE5yUM" target="_blank" class="bg-[#004B93] text-white px-8 py-4 rounded-2xl font-black inline-flex items-center gap-3 hover:bg-blue-800 transition shadow-lg">
                                    <i class="fas fa-external-link-alt text-sm"></i>
                                    <span>LIHAT ULASAN NENG APRIL</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="bg-white p-2 rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden transform hover:rotate-1 transition duration-500">
                            <img src="{{ asset('images/ulasan2.webp') }}" alt="Ulasan Amir Windu" class="rounded-[2rem] w-full object-cover">
                        </div>
                        <div class="space-y-6 lg:pl-6 text-left">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <h3 class="text-3xl font-black text-slate-800 italic leading-tight uppercase">"Harga Terjangkau & Bisa Bayar Mudah"</h3>
                            <p class="text-slate-600 text-lg leading-relaxed font-medium">
                                <strong>Amir Windu</strong> merekomendasikan produk kami karena kualitasnya yang beragam, harga terjangkau, serta sistem pembayaran yang cepat dan mendukung belanja lewat TikTok.
                            </p>
                            <div class="pt-4">
                                <a href="https://maps.app.goo.gl/GY2jcZRsj9cnjTJfA" target="_blank" class="bg-[#004B93] text-white px-8 py-4 rounded-2xl font-black inline-flex items-center gap-3 hover:bg-blue-800 transition shadow-lg">
                                    <i class="fas fa-external-link-alt text-sm"></i>
                                    <span>LIHAT ULASAN AMIR WINDU</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination !-bottom-2"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.testiSwiper', {
            loop: true,
            effect: 'fade',
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>    

<section class="py-24 bg-white px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                
                <div class="lg:w-1/2 space-y-8">
                    <div class="space-y-2">
                        <span class="text-[#0EA5E9] font-black text-[10px] uppercase tracking-[0.4em]">Tentang Kami</span>
                        <h2 class="text-3xl md:text-5xl font-black italic uppercase text-slate-900 leading-[0.9] tracking-tighter">
                            Dedikasi Untuk <br><span class="text-[#004B93]">Keluarga</span> Cikarang.
                        </h2>
                    </div>
                    
                    <p class="text-slate-500 text-sm md:text-base leading-relaxed font-medium">
                        Berawal dari keinginan menyediakan bahan pangan berkualitas, <span class="text-[#004B93] font-bold">Alfa Frozen Jaya</span> kini hadir sebagai pusat grosir dan eceran frozen food terpercaya. Kami memahami bahwa kesegaran adalah kunci, itulah mengapa distribusi kami selalu mengutamakan rantai dingin yang terjaga.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="border-l-4 border-[#FF2800] pl-4">
                            <span class="block text-2xl font-black text-slate-900">4+</span>
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Cabang Aktif</span>
                        </div>
                        <div class="border-l-4 border-[#0EA5E9] pl-4">
                            <span class="block text-2xl font-black text-slate-900">100%</span>
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Jaminan Halal</span>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="inline-flex items-center gap-3 text-[11px] font-black uppercase text-[#004B93] group">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                        Pelajari Profil Lengkap 
                        <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center group-hover:bg-[#004B93] group-hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </a>
                </div>

                <div class="lg:w-1/2 w-full">
                    <div class="bg-slate-50 rounded-[3rem] p-8 md:p-12 border border-slate-100 relative">
                        <h3 class="text-xl font-black italic uppercase text-[#004B93] mb-8 tracking-tighter">Kunjungi Cabang Kami</h3>
                        
                        <div class="space-y-6">
                            @php
                                $summaryStores = [
                                    ['Pusat Jababeka', 'Cikarang Pusat'],
                                    ['Cabang Ciantra', 'Cikarang Selatan'],
                                    ['Cabang Mega Regency', 'Serang Baru'],
                                    ['Cabang Pilar', 'Cikarang Utara'],
                                ];
                            @endphp

                            @foreach($summaryStores as $store)
                            <div class="flex items-center justify-between group cursor-default">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-[#FF2800] group-hover:bg-[#FF2800] group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-black uppercase text-slate-800">{{ $store[0] }}</h4>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $store[1] }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('about') }}#lokasi" class="text-[10px] font-black text-[#0EA5E9] opacity-0 group-hover:opacity-100 transition-opacity uppercase italic">Lihat Map</a>
                            </div>
                            <div class="h-[1px] bg-slate-200 last:hidden w-full"></div>
                            @endforeach
                        </div>

                        <div class="mt-10">
                            <a href="{{ route('about') }}#lokasi" class="block w-full text-center bg-[#004B93] text-white py-4 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-blue-900/20 hover:bg-[#0EA5E9] transition-all">
                                Cek Lokasi via Google Maps
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="px-6 pb-24">
        <div class="max-w-7xl mx-auto bg-slate-900 rounded-[3rem] p-8 md:p-16 text-center relative overflow-hidden shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-5xl font-black italic text-white mb-6 tracking-tighter">Mulai Bisnis Kuliner Anda Bersama Kami</h2>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                    Nikmati harga khusus reseller untuk ratusan produk frozen food dan sembako berkualitas.
                </p>
                <a href="{{ route('reseller') }}" class="inline-block bg-[#004B93] text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-blue-800 transition shadow-xl">
                    Info Reseller
                </a>
            </div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-500/10 rounded-full blur-[100px]"></div>
        </div>
    </section>
</x-guest-layout>