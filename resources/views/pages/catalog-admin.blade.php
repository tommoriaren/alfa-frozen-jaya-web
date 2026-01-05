<x-guest-layout>
    <div class="bg-[#004B93] pt-12 pb-24 px-4 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition border border-white/20 mb-6">
                <i class="fas fa-arrow-left text-xs"></i> 
                Kembali ke Dashboard
            </a>

            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-black italic uppercase tracking-tighter">Manajemen Katalog</h1>
                    <p class="text-blue-100 text-sm opacity-90 italic">Daftar Produk Alfa Frozen Jaya</p>
                </div>
                <a href="{{ route('admin.product.create') }}" class="bg-yellow-400 text-[#004B93] px-6 py-3 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-yellow-300 transition shadow-lg shadow-yellow-900/20">
                    <i class="fas fa-plus mr-2"></i> Tambah Produk
                </a>
            </div>
        </div>
        <i class="fas fa-box-open absolute -right-4 -bottom-4 text-8xl text-white/5 rotate-12"></i>
    </div>

    <div class="max-w-7xl mx-auto px-4 -mt-12 mb-6 relative z-10">
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-6">
            <form action="{{ route('admin.product.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="md:col-span-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic tracking-widest">Cari Nama Produk</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: Sosis Bakar..." 
                           class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 text-xs mt-1 focus:ring-2 focus:ring-[#004B93] font-bold text-slate-700">
                </div>

                {{-- Bagian Select Kategori --}}
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic tracking-widest">Kategori</label>
                    <select name="category" onchange="this.form.submit()" class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 text-xs mt-1 font-bold text-slate-700 focus:ring-2 focus:ring-[#004B93] shadow-inner cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @php
                            // Best Practice: Ambil kategori unik yang benar-benar ada di database
                            $dbCategories = \App\Models\Product::select('category')
                                            ->distinct()
                                            ->whereNotNull('category')
                                            ->orderBy('category', 'asc')
                                            ->pluck('category');
                        @endphp
                        @foreach($dbCategories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-[#004B93] text-white font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-blue-800 transition shadow-md">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>

                    <a href="{{ route('admin.product.index') }}" class="flex-1 bg-slate-100 text-slate-400 font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-slate-200 transition border border-slate-200 text-center">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-20 relative z-10">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100">
                            <th class="px-8 py-6">Gambar</th>
                            <th class="px-6 py-6">Nama Produk</th>
                            <th class="px-6 py-6">Kategori</th>
                            <th class="px-6 py-6">Harga</th>
                            <th class="px-6 py-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($products as $product)
                        <tr class="hover:bg-slate-50/50 transition duration-300">
                            <td class="px-8 py-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 rounded-2xl object-cover shadow-sm border-2 border-white ring-1 ring-slate-100 transition-transform group-hover:scale-105">
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-300">
                                        <i class="fas fa-image text-xl"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-slate-800 uppercase italic leading-tight">{{ $product->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-50 text-[#004B93] text-[9px] font-black uppercase rounded-full border border-blue-100">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-700">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    {{-- TOMBOL EDIT --}}
                                    <a href="{{ route('admin.product.edit', $product->id) }}" 
                                        class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all shadow-md active:scale-95 group">
                                        <i class="fas fa-edit text-[10px]"></i>
                                        <span class="text-[10px] font-black uppercase italic tracking-widest">Edit</span>
                                    </a>
                                    
                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $product->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all shadow-md active:scale-95 group">
                                            <i class="fas fa-trash text-[10px]"></i>
                                            <span class="text-[10px] font-black uppercase italic tracking-widest">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-slate-400 italic text-sm">
                                Belum ada data produk atau hasil filter tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-guest-layout>