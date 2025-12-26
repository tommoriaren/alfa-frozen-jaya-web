<x-guest-layout>
    <div class="bg-[#004B93] pt-8 pb-16 text-center text-white px-4">
        <h1 class="text-2xl md:text-4xl font-black italic">Katalog Produk</h1>
        <p class="text-blue-100 mt-2 max-w-xl mx-auto text-sm md:text-base">
            Temukan berbagai kebutuhan frozen food, bahan pokok, hingga kebutuhan rumah tangga.
        </p>
    </div>

    <div class="bg-slate-50 min-h-screen pb-24 -mt-8 rounded-t-3xl relative z-10">
        <div class="max-w-7xl mx-auto px-4 pt-8">
            
            <div class="flex flex-col md:flex-row gap-8">
                
                <aside class="hidden md:block w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-4">
                        <h3 class="font-bold text-slate-800 text-lg border-b pb-2 border-slate-200">Kategori</h3>
                        
                        <div class="flex flex-col space-y-2">
                            @php $currentCat = request('category'); @endphp

                            <a href="{{ route('catalog', ['category' => 'Semua', 'search' => request('search')]) }}" 
                               class="flex items-center justify-between px-4 py-2 rounded-lg text-sm font-semibold transition
                               {{ !$currentCat || $currentCat == 'Semua' 
                                    ? 'bg-[#FF2800] text-white shadow-md' 
                                    : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-[#FF2800]' }}">
                                <span>Semua Produk</span>
                                <span class="text-xs opacity-70">📦</span>
                            </a>

                            @foreach($categories as $cat)
                                <a href="{{ route('catalog', ['category' => $cat, 'search' => request('search')]) }}" 
                                   class="flex items-center justify-between px-4 py-2 rounded-lg text-sm font-semibold transition
                                   {{ $currentCat == $cat
                                        ? 'bg-[#FF2800] text-white shadow-md' 
                                        : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-[#FF2800]' }}">
                                    <span>{{ $cat }}</span> 
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>


                <main class="flex-1">
                    
                    <div class="sticky top-[65px] z-30 bg-slate-50/95 backdrop-blur py-2 space-y-3 mb-6">
                        
                        <form action="{{ route('catalog') }}" method="GET" class="relative w-full">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-11 pr-3 py-3 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#004B93] focus:border-[#004B93] sm:text-sm shadow-sm" placeholder="Cari nama barang...">
                        </form>

                        <div class="md:hidden w-full overflow-hidden">
                            <div class="flex gap-4 overflow-x-auto pb-4 no-scrollbar">
                                {{-- 1. Tombol 'Semua' (Manual) --}}
                                {{-- Jangan gunakan route('catalog', ['category' => 'Semua']) --}}
                                <a href="{{ route('catalog') }}" 
                                    class="flex items-center justify-between w-full px-4 py-3 rounded-xl 
                                    {{ !request('category') ? 'bg-[#FF2800] text-white' : 'bg-white text-slate-500' }} 
                                    font-black uppercase text-[10px] tracking-widest shadow-lg shadow-red-100">
                                    Semua Produk
                                    <i class="fas fa-box-open"></i>
                                </a>

                                {{-- 2. Tombol Kategori (Otomatis dari Database) --}}
                                @foreach($categories as $cat)
                                    <a href="{{ route('catalog', ['category' => $cat]) }}" 
                                        class="flex-shrink-0 px-4 py-2 rounded-full text-xs font-bold border transition-all
                                        {{ $currentCat == $cat ? 'bg-[#FF2800] text-white border-[#FF2800]' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
        
                                        {{-- Sekarang pasti muncul teks bersih, misal: Makanan Beku --}}
                                        {{ $cat }} 
        
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if($products->count() > 0)
                        <div class="mb-4 text-sm text-slate-600 font-medium">
                            Menampilkan {{ $products->firstItem() }} sampai {{ $products->lastItem() }} dari total {{ $products->total() }} produk.
                            @if($currentCat && $currentCat != 'Semua')
                                <span class="text-[#FF2800] font-bold">({{ $currentCat }})</span>
                            @endif
                            @if(request('search'))
                                <span class="text-[#004B93] font-bold"> - Cari: "{{ request('search') }}"</span>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                            @foreach($products as $product)
                            <article class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-lg transition duration-300 group relative">
                                
                                <div class="aspect-square bg-slate-100 relative overflow-hidden">
                                    <div class="absolute top-2 left-2 z-10 max-w-[85%]">
                                        <span class="bg-white/90 backdrop-blur text-[#004B93] text-[9px] font-bold px-2 py-1 rounded shadow-sm block truncate">
                                            {{ $product->category }}
                                        </span>
                                    </div>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                    @else
                                         <div class="w-full h-full flex items-center justify-center text-slate-300">
                                             <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                         </div>
                                    @endif
                                </div>

                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="text-base font-extrabold text-slate-800 leading-snug mb-2 line-clamp-2 flex-grow group-hover:text-[#004B93]">{{ $product->name }}</h3>
                                    
                                    <div class="mt-auto pt-3 border-t border-slate-50">
                                        <span class="block text-xl font-black text-[#FF2800]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                
                            </article>
                            @endforeach
                        </div>

                        <div class="mt-10">
                            {{ $products->links() }}
                        </div>
                        
                    @else
                        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-300">
                            <div class="text-5xl mb-4">🛒</div>
                            <h3 class="text-xl font-bold text-slate-700">Produk Tidak Ditemukan</h3>
                            <p class="text-slate-500 mt-2">Coba pilih kategori "Semua" atau cari kata lain.</p>
                            <a href="{{ route('catalog') }}" class="inline-block mt-4 px-6 py-2 bg-slate-100 rounded-full text-slate-600 font-bold hover:bg-slate-200 transition">Reset Filter</a>
                        </div>
                    @endif

                </main>
            </div>
        </div>
    </div>
</x-guest-layout>