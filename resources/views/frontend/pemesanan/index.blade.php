<x-guest-layout>
    <section class="pt-12 pb-12 bg-gradient-to-r min-h-screen from-[#1f1f22] to-[#151518]">
        <div class="container mx-auto p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Menu List (Left) -->
                <div class="lg:col-span-2">
                    <div class="bg-[#0D0D0B] rounded-lg shadow-lg">
                        <div class="border-b border-gray-700 p-4">
                            <h2 class="text-2xl font-semibold text-white">Daftar Menu</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($menus as $menu)
                                    <div class="bg-[#1A1A1C] rounded-lg shadow-md overflow-hidden menu-item">
                                        <div class="aspect-w-16 aspect-h-9">
                                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                                                class="object-cover w-full h-full">
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-white mb-2">{{ $menu->nama }}</h3>
                                            <p class="text-sm text-gray-400 mt-1 line-clamp-2">
                                                {{ $menu->detailMenus->pluck('nama')->join(', ') }}
                                            </p>
                                            <p class="text-[#E0C48B] text-lg mb-4">
                                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                            </p>
                                            <button
                                                class="w-full bg-[#FFE077] text-black font-semibold py-2 px-4 rounded-md hover:bg-[#b69b41] transition-colors duration-200 btn-add-menu"
                                                data-menu="{{ json_encode([
                                                    'id' => $menu->idMenu,
                                                    'nama' => $menu->nama,
                                                    'harga' => $menu->harga,
                                                ]) }}">
                                                <span class="btn-text">Tambah</span>
                                                <span class="btn-loading hidden">Menammbah</span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Form (Right) -->
                <div class="lg:col-span-1">
                    <div class="bg-[#0D0D0B] rounded-lg shadow-lg sticky top-6">
                        <div class="border-b border-gray-700 p-4">
                            <h2 class="text-2xl font-semibold text-white">Pesananmu</h2>
                        </div>
                        <div class="p-6">
                            <form id="orderForm" class="space-y-6">
                                <div id="orderItems" class="space-y-4 max-h-[60vh] overflow-y-auto"></div>

                                <div id="emptyOrderMessage" class="text-gray-400 text-center py-4">
                                    Tidak Ada Pesanan
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-white">Tipe Order</label>
                                    <select name="orderType" required
                                        class="w-full p-3 bg-[#1A1A1C] border border-gray-700 text-white rounded-md focus:outline-none focus:border-[#FFE077] transition-colors">
                                        <option value="takeaway">Take Away</option>
                                        <option value="delivery">Delivery</option>
                                    </select>
                                </div>

                                <div class="border-t border-gray-700 pt-4">
                                    <div class="flex justify-between items-center text-white">
                                        <h3 class="text-xl font-semibold">Total:</h3>
                                        <p class="text-xl text-[#E0C48B]">Rp <span id="totalAmount">0</span></p>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-[#FFE077] text-black font-semibold py-3 px-4 rounded-md hover:bg-[#b69b41] transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="btn-text">Buat Pesanan</span>
                                    <span class="btn-loading hidden">Proses...</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div id="toast" class="fixed bottom-4 right-4 transform transition-transform duration-300 translate-y-full">
            <div class="px-6 py-3 rounded-lg shadow-lg">
                <span id="toastMessage"></span>
            </div>
        </div>
    </section>
</x-guest-layout>
