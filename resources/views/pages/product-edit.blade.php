<x-guest-layout>
    <div class="max-w-2xl mx-auto py-20 px-4">
        <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-black italic uppercase tracking-tighter text-[#004B93]">Edit Data Produk</h2>
                <span class="bg-slate-100 text-slate-400 text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">Update Mode</span>
            </div>
            
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Nama Produk</label>
                        <input type="text" name="name" value="{{ $product->name }}" required 
                               class="w-full bg-slate-50 border-none rounded-2xl p-4 mt-1 font-bold text-slate-700 focus:ring-2 focus:ring-[#004B93]">
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Kategori</label>
                        <select name="category" class="w-full bg-slate-50 border-none rounded-2xl p-4 mt-1 font-bold text-slate-700 focus:ring-2 focus:ring-[#004B93]">
                            <option value="Makanan Beku" {{ $product->category == 'Makanan Beku' ? 'selected' : '' }}>Makanan Beku</option>
                            <option value="Produk Dairy" {{ $product->category == 'Produk Dairy' ? 'selected' : '' }}>Produk Dairy</option>
                            <option value="Bahan Pokok" {{ $product->category == 'Bahan Pokok' ? 'selected' : '' }}>Bahan Pokok</option>
                            <option value="Bumbu Masak" {{ $product->category == 'Bumbu Masak' ? 'selected' : '' }}>Bumbu Masak</option>
                            <option value="Bahan Kue" {{ $product->category == 'Bahan Kue' ? 'selected' : '' }}>Bahan Kue</option>
                            <option value="Minuman" {{ $product->category == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Rumah Tangga" {{ $product->category == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Harga Jual (Rp)</label>
                        <input type="number" name="price" value="{{ $product->price }}" required 
                               class="w-full bg-slate-50 border-none rounded-2xl p-4 mt-1 font-bold text-slate-700 focus:ring-2 focus:ring-[#004B93]">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Foto Produk</label>
                        <div class="flex items-center gap-5 mt-2 p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 rounded-xl object-cover shadow-md">
                            <div class="flex-1">
                                <input type="file" name="image" class="text-[10px] text-slate-400 mb-1">
                                <p class="text-[9px] text-slate-400">*Biarkan kosong jika tidak ingin mengganti foto.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-[#004B93] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-blue-800 transition uppercase italic tracking-widest text-xs">
                        Simpan Perubahan
                    </button>
                    
                    <a href="{{ route('admin.product.index') }}" class="flex-1 bg-slate-100 text-slate-400 text-center py-4 rounded-2xl font-black transition uppercase italic tracking-widest text-xs border border-transparent hover:border-slate-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>