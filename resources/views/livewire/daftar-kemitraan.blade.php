<form wire:submit.prevent="submitForm" class="space-y-6">

    @if ($successMessage)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $successMessage }}</span>
        </div>
    @endif

    <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap Pemilik Usaha <span class="text-red-500">*</span></label>
        <input wire:model="nama" type="text" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#004B93] focus:ring-[#004B93] sm:text-sm">
        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
        <input wire:model="telepon" type="tel" id="telepon" placeholder="Contoh: 0812XXXXXXXX" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#004B93] focus:ring-[#004B93] sm:text-sm">
        @error('telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="area" class="block text-sm font-medium text-gray-700">Area/Kecamatan Domisili <span class="text-red-500">*</span></label>
        <input wire:model="area" type="text" id="area" placeholder="Contoh: Cikarang Selatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#004B93] focus:ring-[#004B93] sm:text-sm">
        @error('area') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="minat" class="block text-sm font-medium text-gray-700">Minat Kulakan <span class="text-red-500">*</span></label>
        <select wire:model="minat" id="minat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#004B93] focus:ring-[#004B93] sm:text-sm">
            <option value="">-- Pilih Minat --</option>
            <option value="Reseller (Volume Kecil)">Reseller (Volume Kecil)</option>
            <option value="Toko/Agen (Volume Sedang)">Toko/Agen (Volume Sedang)</option>
            <option value="Distributor/Katering (Volume Besar)">Distributor/Katering (Volume Besar)</option>
        </select>
        @error('minat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF2800] hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF2800]">
            Kirim Pendaftaran
        </button>
    </div>
</form>