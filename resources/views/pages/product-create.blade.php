<x-guest-layout>
    <div class="max-w-2xl mx-auto py-20 px-4">
        <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-slate-100">
            <h2 class="text-2xl font-black italic uppercase tracking-tighter text-[#004B93] mb-8">Tambah Produk Baru</h2>
            
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Nama Produk</label>
                        <input type="text" name="name" required placeholder="Contoh: Kanzler Sosis Bakar"
                               class="w-full bg-slate-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-[#004B93]">
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Kategori</label>
                        <select name="category" class="w-full bg-slate-50 border-none rounded-2xl p-4 mt-1 font-bold text-slate-700 focus:ring-2 focus:ring-[#004B93]">
                            <option value="Makanan Beku">Makanan Beku</option>
                            <option value="Produk Dairy">Produk Dairy</option>
                            <option value="Bahan Pokok">Bahan Pokok</option>
                            <option value="Bumbu Masak">Bumbu Masak</option>
                            <option value="Bahan Kue">Bahan Kue</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Rumah Tangga">Rumah Tangga</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Harga Jual (Rp)</label>
                        <input type="number" name="price" required placeholder="0"
                               class="w-full bg-slate-50 border-none rounded-2xl p-4 mt-1 focus:ring-2 focus:ring-[#004B93]">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 italic">Unggah Foto Produk</label>
                        <div class="mt-2 p-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200 text-center">
                            <input type="file" name="image" required class="text-xs text-slate-400">
                            <p class="text-[9px] text-slate-400 mt-2 uppercase tracking-widest font-bold">*Maksimal Ukuran: 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-[#004B93] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-blue-800 transition uppercase italic tracking-widest text-xs">
                        Simpan Produk
                    </button>
                    
                    <a href="{{ route('admin.product.index') }}" class="flex-1 bg-slate-100 text-slate-400 text-center py-4 rounded-2xl font-black transition uppercase italic tracking-widest text-xs border border-transparent hover:border-slate-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>