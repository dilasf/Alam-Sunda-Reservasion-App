<x-guest-layout>
    <!-- Main Hero Content -->
    <section class="pt-12 pb-12 bg-gradient-to-r from-[#1f1f22] to-[#151518] font-['Inter',sans-serif]">
        <div class="container mx-auto p-6 sm:p-12 md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Reservasi Online (Bagian Kiri) -->
                <div
                    class="md:col-span-2 bg-gradient-to-br from-[#151518] to-[#1f1f22] shadow-2xl rounded-lg p-8 text-white">

                    <h2 class="text-3xl font-bold mb-1 text-center text-yellow-400">Struk Reservasi</h2>
                    <p class="text-sm mb-6 text-center text-white">ScreenShoot Struk Reservasi ini</p>
                    <div class="border-b border-gray-700 pb-4 mb-4">
                        <p class="text-lg font-semibold mb-2 text-yellow-400">Informasi Reservasi</p>
                        <div class="grid grid-cols-2 gap-2">
                            <p><span class="font-medium">No Reservasi:</span></p>
                            <p class="text-right">#{{ $reservasi->idReservasi }}</p>
                            <p><span class="font-medium">Nama:</span></p>
                            <p class="text-right">{{ $reservasi->nama_depan }} {{ $reservasi->nama_belakang }}</p>
                            <p><span class="font-medium">Email:</span></p>
                            <p class="text-right">{{ $reservasi->email }}</p>
                            <p><span class="font-medium">No. Telepon:</span></p>
                            <p class="text-right">{{ $reservasi->no_telepon }}</p>
                        </div>
                    </div>
                    <div class="border-b border-gray-700 pb-4 mb-4">
                        <p class="text-lg font-semibold mb-2 text-yellow-400">Detail Reservasi</p>
                        <div class="grid grid-cols-2 gap-2">
                            <p><span class="font-medium">Tanggal Reservasi:</span></p>
                            <p class="text-right">
                                {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d M Y H:i') }} -
                                {{ \Carbon\Carbon::parse($reservasi->tanggal)->addHours(2)->format('H:i') }}
                            </p>
                            <p><span class="font-medium">Jumlah Pengunjung:</span></p>
                            <p class="text-right">{{ $reservasi->jumlahPengunjung }}</p>
                            <p><span class="font-medium">Nomor Meja:</span></p>
                            <p class="text-right">{{ $reservasi->idMeja }}</p>
                            <p><span class="font-medium">Status Reservasi:</span></p>
                            <p class="text-right">
                                <span
                                    class="px-2 py-1 rounded {{ $reservasi->status == 'dikonfirmasi' ? 'bg-green-600' : 'bg-yellow-600' }}">
                                    {{ ucfirst($reservasi->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    @if ($reservasi->transaksi)
                        <div class="mt-6">
                            <p class="text-lg font-semibold mb-2 text-yellow-400">Detail Pembayaran</p>
                            <div class="grid grid-cols-2 gap-2">
                                <p><span class="font-medium">Total Pembayaran:</span></p>
                                <p class="text-right">Rp
                                    {{ number_format($reservasi->transaksi->totalPembayaran, 0, ',', '.') }}</p>
                                {{-- <p><span class="font-medium">Total Dibayar:</span></p>
                                <p class="text-right">Rp
                                    {{ number_format($reservasi->transaksi->totalDibayar, 0, ',', '.') }}</p> --}}
                                <p><span class="font-medium">Status Pembayaran:</span></p>
                                <p class="text-right">
                                    <span
                                        class="px-2 py-1 rounded {{ $reservasi->transaksi->status == 'dibayar' ? 'bg-green-600' : 'bg-red-600' }}">
                                        {{ ucfirst($reservasi->transaksi->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endif
                    <div class="mt-6">
                        <a href="{{ route('frontend.reservasi.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                <!-- Contact Us (Bagian Kanan) -->
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
