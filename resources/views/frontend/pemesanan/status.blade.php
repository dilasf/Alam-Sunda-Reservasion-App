<x-guest-layout>
    <!-- Main Hero Content -->
    <section class="pt-12 pb-12 bg-gradient-to-r from-[#1f1f22] to-[#151518] font-['Inter',sans-serif]">
        <div class="container mx-auto p-6 sm:p-12 md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Struk Pemesanan (Bagian Kiri) -->
                <div
                    class="md:col-span-2 bg-gradient-to-br from-[#151518] to-[#1f1f22] shadow-2xl rounded-lg p-8 text-white">
                    <h2 class="text-3xl font-bold mb-1 text-center text-yellow-400">Struk Pemesanan</h2>
                    <p class="text-sm mb-6 text-center text-white">Screenshot Struk Pemesanan ini</p>

                    <!-- Informasi Pesanan -->
                    <div class="border-b border-gray-700 pb-4 mb-4">
                        <p class="text-lg font-semibold mb-2 text-yellow-400">Informasi Pesanan</p>
                        <div class="grid grid-cols-2 gap-2">
                            <p><span class="font-medium">No Pesanan:</span></p>
                            <p class="text-right">#{{ $pesanan->idPesanan }}</p>
                            <p><span class="font-medium">Tanggal:</span></p>
                            <p class="text-right">
                                {{ \Carbon\Carbon::parse($pesanan->tanggalPesanan)->format('d M Y H:i') }}</p>
                            <p><span class="font-medium">Tipe Pesanan:</span></p>
                            <p class="text-right">{{ ucfirst($pesanan->tipePesanan) }}</p>
                            <p><span class="font-medium">Status Pesanan:</span></p>
                            <p class="text-right">
                                <span
                                    class="px-2 py-1 rounded {{ $pesanan->status == 'diproses' ? 'bg-green-600' : 'bg-yellow-600' }}">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            </p>
                            @if ($pesanan->tipePesanan === 'takeaway' && $pesanan->pengiriman)
                                <p><span class="font-medium">Keterangan:</span></p>
                                <p class="text-right">Silahkan Ambil Pesananmu Di Alam Sunda Cabang Cipayung Bogor</p>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Item Pesanan -->
                    <div class="border-b border-gray-700 pb-4 mb-4">
                        <p class="text-lg font-semibold mb-2 text-yellow-400">Detail Item</p>
                        @foreach ($pesanan->itemPesanan as $item)
                            <div class="grid grid-cols-4 gap-2 mb-2">
                                <p class="col-span-2">{{ $item->menu->nama }}</p>
                                <p class="text-center">x{{ $item->jumlah }}</p>
                                <p class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                        @if ($pesanan->tipePesanan === 'delivery' && $pesanan->pengiriman)
                            <div class="grid grid-cols-4 gap-2 mb-2">
                                <p class="col-span-2">Biaya Pengiriman</p>
                                <p class="text-center"></p>
                                <p class="text-right">Rp 150.000</p>
                            </div>
                        @endif
                        <div class="mt-2 pt-2 border-t border-gray-700">
                            <div class="grid grid-cols-2">
                                <p class="font-medium">Total:</p>
                                <p class="text-right">Rp {{ number_format($pesanan->jumlahTotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pengiriman (jika delivery) -->
                    @if ($pesanan->tipePesanan === 'delivery' && $pesanan->pengiriman)
                        <div class="border-b border-gray-700 pb-4 mb-4">
                            <p class="text-lg font-semibold mb-2 text-yellow-400">Informasi Pengiriman</p>
                            <div class="grid grid-cols-2 gap-2">
                                <p><span class="font-medium">Nama Penerima:</span></p>
                                <p class="text-right">{{ $pesanan->pengiriman->nama }}</p>

                                <p><span class="font-medium">No. Telepon:</span></p>
                                <p class="text-right">{{ $pesanan->pengiriman->nomorTelepon }}</p>

                                <p><span class="font-medium">Alamat:</span></p>
                                <p class="text-right">{{ $pesanan->pengiriman->alamat }}</p>

                                <p><span class="font-medium">Tanggal Pengiriman:</span></p>
                                <p class="text-right">
                                    {{ \Carbon\Carbon::parse($pesanan->pengiriman->waktuPengiriman)->format('d/m/Y') }}
                                </p>

                                <p><span class="font-medium">Waktu Pengiriman:</span></p>
                                <p class="text-right">
                                    {{ \Carbon\Carbon::parse($pesanan->pengiriman->waktuPengiriman)->format('H:i') }}
                                    WIB</p>

                                @if ($pesanan->pengiriman->catatan)
                                    <p><span class="font-medium">Catatan:</span></p>
                                    <p class="text-right">{{ $pesanan->pengiriman->catatan }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Detail Pembayaran -->
                    @if ($pesanan->transaksi)
                        <div class="mt-6">
                            <p class="text-lg font-semibold mb-2 text-yellow-400">Detail Pembayaran</p>
                            <div class="grid grid-cols-2 gap-2">
                                <p><span class="font-medium">Total Pembayaran:</span></p>
                                <p class="text-right">Rp
                                    {{ number_format($pesanan->transaksi->totalPembayaran, 0, ',', '.') }}</p>
                                <p><span class="font-medium">Total Dibayar:</span></p>
                                <p class="text-right">Rp
                                    {{ number_format($pesanan->transaksi->totalDibayar, 0, ',', '.') }}</p>
                                <p><span class="font-medium">Status Pembayaran:</span></p>
                                <p class="text-right">
                                    <span
                                        class="px-2 py-1 rounded {{ $pesanan->transaksi->status == 'dibayar' ? 'bg-green-600' : 'bg-yellow-600' }}">
                                        {{ ucfirst($pesanan->transaksi->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Tombol Kembali -->
                    <div class="mt-6">
                        <a href="{{ route('frontend.pemesanan.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Menu
                        </a>
                    </div>
                </div>
                <div class="bg-no-repeat bg-cover bg-center p-8 h-full text-center font-['Inter',sans-serif]"
                    style="background-image: url('{{ asset('src/images/cover/form-pattern.png') }}')">
                    <h1 class="text-4xl mb-6 text-white">Hubungi Kami</h1>
                    <p class="text-lg mb-4 text-white">
                        Butuh Bantuan? Hubungi <span class="text-[#E0C48B]">+62 812-2397-8735</span>
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-md mb-4 text-white">
                        <strong>Lokasi</strong><br>
                        Jl. Raya Puncak - Gadog No.239, Kec. Megamendung, Kabupaten Bogor, Jawa Barat
                        16770
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-md mb-4 text-white">
                        <strong>Jam Buka</strong><br>
                        Senin sampai Minggu<br>
                        09.00 am - 09.00pm
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
