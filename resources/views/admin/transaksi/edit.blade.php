<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                {{-- Menu --}}
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        {{-- Admin / --}}
                        <a class="font-medium" href="{{ route('admin.transaksi.index') }}">Transaksi /</a>
                    </li>
                    <li class="text-primary">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-black dark:text-white">Edit Transaksi</h1>
                <a href="{{ route('admin.transaksi.index') }}"
                    class="bg-meta-4 hover:bg-gray-600 text-white py-2 px-4 rounded transition duration-200">
                    Kembali
                </a>
            </div>

            {{-- Alert Messages --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <div
                class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                <form action="{{ route('admin.transaksi.update', $transaksi) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Detail Transaksi berdasarkan tipe --}}
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-black dark:text-white mb-4">
                            Detail {{ $transaksi->pesanan ? 'Pesanan' : 'Reservasi' }}
                        </h2>
                        <div class="grid grid-cols-2 gap-4 p-4 bg-gray-200 dark:bg-meta-4 rounded-sm">
                            @if ($transaksi->pesanan)
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">ID Pesanan:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ $transaksi->pesanan->idPesanan }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Nama Pemesan:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ $transaksi->pesanan->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Tipe Pesanan:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ ucfirst($transaksi->pesanan->tipePesanan) }}</p>
                                </div>
                                @if ($transaksi->pesanan->pengiriman)
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Alamat Pengiriman:</p>
                                        <p class="font-medium text-black dark:text-white">
                                            {{ $transaksi->pesanan->pengiriman->alamat }}
                                        </p>
                                    </div>
                                @endif
                            @else
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Nama Pemesan:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ $transaksi->reservasi->nama_depan }}
                                        {{ $transaksi->reservasi->nama_belakang }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Email:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ $transaksi->reservasi->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Tanggal Reservasi:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ \Carbon\Carbon::parse($transaksi->reservasi->tanggal)->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Pengunjung:</p>
                                    <p class="font-medium text-black dark:text-white">
                                        {{ $transaksi->reservasi->jumlahPengunjung }} orang
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Detail Pembayaran --}}
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Detail Pembayaran</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran:</p>
                                <p class="font-medium text-black dark:text-white">
                                    Rp {{ number_format($transaksi->totalPembayaran, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <label for="totalPembayaran" class="block text-sm text-gray-600 dark:text-gray-400">
                                    Update Total Pembayaran (opsional):
                                </label>
                                <input type="number" name="totalPembayaran" id="totalPembayaran"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                    value="{{ old('totalPembayaran', $transaksi->totalPembayaran) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Bukti Pembayaran --}}
                    @if ($transaksi->fotoBukti)
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Bukti Pembayaran</h2>
                            <div class="border border-stroke dark:border-strokedark rounded p-4">
                                <img src="{{ Storage::url($transaksi->fotoBukti) }}"
                                    alt="{{ $transaksi->idTransaksi }}" class="max-w-md mx-auto rounded shadow">
                            </div>
                        </div>
                    @endif

                    {{-- Status Transaksi --}}
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Status Transaksi
                        </label>
                        <select name="status" id="status"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="pending" {{ $transaksi->status === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="dibayar" {{ $transaksi->status === 'dibayar' ? 'selected' : '' }}>
                                dibayar</option>
                            <option value="diverifikasi" {{ $transaksi->status === 'diverifikasi' ? 'selected' : '' }}>
                                diverifikasi</option>
                            <option value="ditolak" {{ $transaksi->status === 'ditolak' ? 'selected' : '' }}>
                                ditolak</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Current Status Info --}}
                    <div
                        class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-sm border border-yellow-200 dark:border-yellow-900/50">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                            <strong>Catatan:</strong>
                            @if ($transaksi->pesanan)
                                Status "Selesai" akan mengubah status pengiriman menjadi "delivered" jika ini adalah
                                pesanan delivery.
                                Status "Dibatalkan" akan membatalkan pesanan dan pengiriman terkait.
                            @else
                                Status "Terverifikasi" akan mengubah status reservasi menjadi "Dikonfirmasi" dan
                                mengubah status meja menjadi tidak tersedia.
                                Status "Dibatalkan" akan mengubah status reservasi menjadi "Dibatalkan" dan mengubah
                                status meja menjadi tersedia.
                            @endif
                        </p>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end mb-5">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
