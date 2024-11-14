<x-guest-layout>
    <!-- Main Hero Content -->
    <section class="min-h-screen pt-12 pb-12 bg-gradient-to-r from-[#1f1f22] to-[#151518] font-['Inter',sans-serif]">
        <div class="container mx-auto p-6 sm:p-12 md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Reservasi Online (Bagian Kiri) -->
                <div class="md:col-span-2 bg-[#0D0D0B] shadow-lg p-8">
                    <h1 class="text-6xl mb-4 text-white text-center">Reservasi Online</h1>
                    {{-- <p class="text-sm mb-6 text-white text-center">
                        Butuh bantuan? <span class="text-[#E0C48B]">+62 812-2397-8735</span>
                    </p> --}}

                    {{-- Tampilkan informasi transaksi --}}
                    <div class="mb-6 text-white">
                        <div class="p-4 bg-[#1A1A1C]">
                            <p class="mb-2">Total Pembayaran: <span class="text-[#FFE077]">Rp
                                    {{ number_format($transaksi->totalPembayaran, 0, ',', '.') }}</span></p>
                            <p class="text-sm text-gray-400">Transfer ke Rekening ini:</p>
                            <p class="text-sm text-gray-400">BCA: 1970713405 A/n Apep Muhammad Hanafiah </p>
                            <p class="text-sm text-gray-400">Upload bukti pembayaran Anda di bawah ini</p>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST"
                        action="{{ route('frontend.reservasi.upload.store', ['idTransaksi' => $transaksi->idTransaksi]) }}"
                        enctype="multipart/form-data" id="uploadForm" class="space-y-6">
                        @csrf

                        {{-- Preview Image Container --}}
                        <div class="hidden mb-4" id="imagePreview">
                            <img src="#" alt="Preview"
                                class="max-w-full h-auto rounded-lg border border-gray-700">
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="fotoBukti" class="text-white text-sm mb-1">Upload Bukti Pembayaran</label>
                            <div class="relative">
                                <input type="file" name="fotoBukti" id="fotoBukti"
                                    accept="image/jpeg,image/png,image/jpg"
                                    class="p-3 w-full bg-[#1A1A1C] border border-gray-700 text-white
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-none file:border-0
                                              file:text-sm file:bg-[#FFE077]
                                              file:text-black hover:file:bg-[#b69b41]
                                              file:cursor-pointer focus:outline-none
                                              focus:border-[#FFE077] transition-colors
                                              @error('fotoBukti') border-red-500 @enderror"
                                    required>
                            </div>
                            <p class="text-gray-400 text-xs">Format yang diperbolehkan: JPG, JPEG, PNG (Max: 2MB)</p>
                            @error('fotoBukti')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" id="submitButton"
                            class="w-full p-3 bg-[#FFE077] text-black font-bold
                                       hover:bg-[#b69b41] transition-colors
                                       disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="inline-block">UPLOAD BUKTI PEMBAYARAN</span>
                            <span class="hidden" id="loadingText">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black inline-block"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Mengupload...
                            </span>
                        </button>
                    </form>
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
