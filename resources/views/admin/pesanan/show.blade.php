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
                        <a class="font-medium" href="{{ route('admin.pesanan.index') }}">Pesanan /</a>
                    </li>
                    <li class="text-primary">Detail</li>
                </ol>
            </nav>
        </div>
        <div
            class="container mx-auto px-4 py-6 border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-black dark:text-white">Detail Pesanan</h1>
                <a href="{{ route('admin.pesanan.index') }}"
                    class="bg-meta-4 hover:bg-gray-600 text-white py-2 px-4 rounded transition duration-200">
                    Kembali
                </a>
            </div>

            {{-- Alert Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Informasi Pelanggan --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Informasi Pelanggan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-200 dark:bg-meta-4 rounded-sm">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Nama Pelanggan:</p>
                        <p class="font-medium text-black dark:text-white">{{ $pesanan->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Email:</p>
                        <p class="font-medium text-black dark:text-white">{{ $pesanan->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">No Telepon:</p>
                        <p class="font-medium text-black dark:text-white">{{ $pesanan->user->nomorTelepon }}</p>
                    </div>
                </div>
            </div>

            {{-- Informasi Pesanan --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Informasi Pesanan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-200 dark:bg-meta-4 rounded-sm">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">ID Pesanan:</p>
                        <p class="font-medium text-black dark:text-white">{{ $pesanan->idPesanan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tipe Pesanan:</p>
                        <p class="font-medium text-black dark:text-white">{{ ucfirst($pesanan->tipePesanan) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Status:</p>
                        <span
                            class="px-3 py-1 text-xs rounded-full
                            {{ $pesanan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $pesanan->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $pesanan->status === 'dikirim' ? 'bg-indigo-100 text-indigo-800' : '' }}
                            {{ $pesanan->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $pesanan->status === 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tanggal Pesanan:</p>
                        <p class="font-medium text-black dark:text-white">
                            {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Item Pesanan --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Item Pesanan</h2>
                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="max-w-full overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                                    <th class="px-4 py-4 font-medium text-black dark:text-white">No</th>
                                    <th class="px-4 py-4 font-medium text-black dark:text-white">Menu</th>
                                    <th class="px-4 py-4 font-medium text-black dark:text-white">Jumlah</th>
                                    <th class="px-4 py-4 font-medium text-black dark:text-white">Harga Satuan</th>
                                    <th class="px-4 py-4 font-medium text-black dark:text-white">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan->itemPesanan as $index => $item)
                                    <tr>
                                        <td class="border-b border-[#eee] px-4 py-4 dark:border-strokedark">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-4 dark:border-strokedark">
                                            {{ $item->menu->nama }}
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-4 dark:border-strokedark">
                                            {{ $item->jumlah }}
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-4 dark:border-strokedark">
                                            Rp {{ number_format($item->menu->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-4 dark:border-strokedark">
                                            Rp {{ number_format($item->menu->harga * $item->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Informasi Pengiriman --}}
            @if ($pesanan->pengiriman)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Informasi Pengiriman</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-200 dark:bg-meta-4 rounded-sm">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Nama:</p>
                            <p class="font-medium text-black dark:text-white">{{ $pesanan->pengiriman->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Alamat Pengiriman:</p>
                            <p class="font-medium text-black dark:text-white">{{ $pesanan->pengiriman->alamat }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Catatan Pengiriman:</p>
                            <p class="font-medium text-black dark:text-white">
                                {{ $pesanan->pengiriman->catatan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Waktu Pengiriman:</p>
                            <p class="font-medium text-black dark:text-white">
                                {{ \Carbon\Carbon::parse($pesanan->pengiriman->waktuPengiriman)->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Informasi Pembayaran --}}
            @if ($pesanan->transaksi)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-black dark:text-white mb-4">Informasi Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-200 dark:bg-meta-4 rounded-sm">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran:</p>
                            <p class="font-medium text-black dark:text-white">
                                Rp {{ number_format($pesanan->transaksi->totalPembayaran, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Status Pembayaran:</p>
                            <p class="font-medium text-black dark:text-white">
                                {{ ucfirst($pesanan->transaksi->status) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-4.5">
                <a href="{{ route('admin.pesanan.edit', $pesanan->idPesanan) }}"
                    class="inline-flex items-center justify-center gap-2.5 rounded-md bg-primary px-6 py-2.5 text-center font-medium text-white hover:bg-opacity-90">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Pesanan
                </a>
                <form action="{{ route('admin.pesanan.destroy', $pesanan->idPesanan) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')"
                        class="inline-flex items-center justify-center gap-2.5 rounded-md bg-danger px-6 py-2.5 text-center font-medium text-white hover:bg-opacity-90">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus Pesanan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
