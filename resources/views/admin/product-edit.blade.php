<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk: {{ $product->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <select name="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white">
                            <option value="Ayam Olahan" {{ $product->category == 'Ayam Olahan' ? 'selected' : '' }}>Ayam Olahan</option>
                            <option value="Sapi Olahan" {{ $product->category == 'Sapi Olahan' ? 'selected' : '' }}>Sapi Olahan</option>
                            <option value="Seafood" {{ $product->category == 'Seafood' ? 'selected' : '' }}>Seafood</option>
                            <option value="Cemilan" {{ $product->category == 'Cemilan' ? 'selected' : '' }}>Cemilan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Produk</label>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded mb-2 border">
                        @endif
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:bg-blue-50 file:text-blue-700">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('home') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-800">Update Produk</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>