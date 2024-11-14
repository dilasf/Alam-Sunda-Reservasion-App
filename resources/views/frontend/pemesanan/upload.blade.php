<!-- resources/views/frontend/pemesanan/upload.blade.php -->
<x-guest-layout>
    <!-- Main Hero Content -->
    <section class="pt-12 pb-12 bg-gradient-to-r from-[#1f1f22] to-[#151518] font-['Inter',sans-serif]">
        <div class="container mx-auto p-6 sm:p-12 md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Upload Pembayaran (Bagian Kiri) -->
                <div class="md:col-span-2 bg-[#0D0D0B] shadow-lg p-8">
                    <h1 class="text-6xl mb-4 text-white text-center">Upload Pembayaran</h1>
                    <p class="text-sm mb-6 text-white text-center">
                        Butuh bantuan? Hubungi <span class="text-[#E0C48B]">+62 812-2397-8735</span>
                    </p>

                    {{-- Tampilkan informasi pesanan --}}
                    <div class="mb-6 text-white">
                        <div class="p-4 bg-[#1A1A1C] space-y-2">
                            <p class="mb-2">Total Pembayaran: <span class="text-[#FFE077]">Rp
                                    {{ number_format($pesanan->jumlahTotal, 0, ',', '.') }}</span></p>
                            @if ($pesanan->tipePesanan === 'delivery')
                                <p class="text-sm text-gray-400">Alamat Pengiriman: {{ $pesanan->pengiriman->alamat }}
                                </p>
                            @endif
                            <p class="text-sm text-gray-400">Upload bukti pembayaran Anda di bawah ini</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST"
                        action="{{ route('frontend.pemesanan.transaksi.store', ['idPesanan' => $pesanan->idPesanan]) }}"
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

                        <div class="flex flex-col space-y-2">
                            <label for="totalDibayar" class="text-white text-sm mb-1">Jumlah yang Dibayar</label>
                            <input type="number" name="totalDibayar" id="totalDibayar"
                                value="{{ $pesanan->jumlahTotal }}" min="0"
                                class="p-3 w-full bg-[#1A1A1C] border border-gray-700 text-white
                                        focus:outline-none focus:border-[#FFE077] transition-colors
                                        @error('totalDibayar') border-red-500 @enderror"
                                required>
                            @error('totalDibayar')
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

                <!-- Informasi Pesanan (Bagian Kanan) -->
                <div class="md:col-span-1 bg-[#0D0D0B] shadow-lg p-8 md:ml-4 mt-4 md:mt-0">
                    <h2 class="text-2xl mb-4 text-white">Detail Pesanan</h2>
                    <div class="space-y-4">
                        @foreach ($pesanan->itemPesanan as $item)
                            <div class="border-b border-gray-700 pb-4">
                                <p class="text-white">{{ $item->menu->nama }}</p>
                                <p class="text-gray-400">{{ $item->jumlah }}x @ Rp
                                    {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <p class="text-[#FFE077]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                        @if ($pesanan->tipePesanan === 'delivery' && $pesanan->pengiriman)
                            <div class="border-b border-gray-700 pb-4">
                                <p class="text-white">Biaya Pengiriman</p>
                                <p class="text-[#FFE077]">Rp 150.000</p>
                            </div>
                        @endif
                        <div class="pt-1">
                            <p class="text-white text-lg font-bold">Total</p>
                            <p class="text-[#FFE077] text-xl">Rp
                                {{ number_format($pesanan->jumlahTotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('uploadForm');
                const submitButton = document.getElementById('submitButton');
                const normalText = submitButton.querySelector('span:not(#loadingText)');
                const loadingText = document.getElementById('loadingText');
                const imageInput = document.getElementById('fotoBukti');
                const imagePreview = document.getElementById('imagePreview');
                const previewImage = imagePreview.querySelector('img');

                // Handle image preview
                imageInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                        }
                        reader.readAsDataURL(this.files[0]);

                        // Validate file size
                        const fileSize = this.files[0].size / 1024 / 1024; // Convert to MB
                        if (fileSize > 2) {
                            alert('Ukuran file tidak boleh lebih dari 2MB');
                            this.value = '';
                            imagePreview.classList.add('hidden');
                        }
                    }
                });

                // Handle form submission
                form.addEventListener('submit', function(e) {
                    const totalDibayar = document.getElementById('totalDibayar');
                    const jumlahTotal = {{ $pesanan->jumlahTotal }};

                    if (parseFloat(totalDibayar.value) < 0) {
                        e.preventDefault();
                        alert('Jumlah yang dibayar tidak boleh kurang dari 0');
                        return;
                    }

                    submitButton.disabled = true;
                    normalText.classList.add('hidden');
                    loadingText.classList.remove('hidden');
                });
            });
        </script>
    @endpush
</x-guest-layout>
