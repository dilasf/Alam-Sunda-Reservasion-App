<x-guest-layout>
    <section class="pt-12 pb-12 bg-gradient-to-r min-h-screen from-[#1f1f22] to-[#151518]">
        <div class="container mx-auto p-6">
            <div class="max-w-2xl mx-auto">
                <div class="bg-[#0D0D0B] rounded-lg shadow-lg">
                    <div class="border-b border-gray-700 p-4">
                        <h2 class="text-2xl font-semibold text-white">Form Pengiriman</h2>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('frontend.pemesanan.pengiriman.store', $pesanan->idPesanan) }}"
                            method="POST" class="space-y-6">
                            @csrf

                            <div class="space-y-4">
                                <!-- Nama -->
                                <div>
                                    <label for="nama" class="block text-white mb-2">Nama Penerima</label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                        class="w-full p-3 bg-[#1A1A1C] border border-gray-700 text-white rounded-md focus:outline-none focus:border-[#FFE077] transition-colors"
                                        required>
                                    @error('nama')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div>
                                    <label for="alamat" class="block text-white mb-2">Alamat Pengiriman</label>
                                    <textarea id="alamat" name="alamat" rows="3"
                                        class="w-full p-3 bg-[#1A1A1C] border border-gray-700 text-white rounded-md focus:outline-none focus:border-[#FFE077] transition-colors"
                                        required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Catatan -->
                                <div>
                                    <label for="catatan" class="block text-white mb-2">Catatan Pengiriman</label>
                                    <textarea id="catatan" name="catatan" rows="2"
                                        class="w-full p-3 bg-[#1A1A1C] border border-gray-700 text-white rounded-md focus:outline-none focus:border-[#FFE077] transition-colors"
                                        placeholder="Tambahkan catatan untuk pengiriman (opsional)">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nomor Telepon -->
                                <div>
                                    <label for="nomorTelepon" class="block text-white mb-2">Nomor Telepon</label>
                                    <input type="text" id="nomorTelepon" name="nomorTelepon"
                                        value="{{ old('nomorTelepon') }}"
                                        class="w-full p-3 bg-[#1A1A1C] border border-gray-700 text-white rounded-md focus:outline-none focus:border-[#FFE077] transition-colors"
                                        required maxlength="14">
                                    @error('nomorTelepon')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Biaya Pengiriman -->
                                <div>
                                    <label class="block text-white mb-2">Biaya Pengiriman</label>
                                    <p class="text-[#E0C48B] text-lg">Rp 150.000</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-700 pt-6">
                                <button type="submit"
                                    class="w-full bg-[#FFE077] text-black font-semibold py-3 px-4 rounded-md hover:bg-[#b69b41] transition-colors duration-200">
                                    Lanjutkan ke Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
