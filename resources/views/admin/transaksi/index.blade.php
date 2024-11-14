<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Transaksi
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li class="font-medium">
                        Admin /
                        {{-- <a class="font-medium" href="index.html">Menu /</a> --}}
                    </li>
                    <li class="text-primary">Transaksi</li>
                </ol>
            </nav>
        </div>
        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <!-- Main Table -->
        <div
            class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-left dark:bg-meta-4">
                            <th class="px-4 py-4 font-medium text-black dark:text-white">ID Pesanan</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">ID Reservasi</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Nama Pemesan</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Tanggal</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Total Pembayaran</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Status</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                <td class="border-t px-4 py-4">
                                    {{ $transaksi->pesanan ? $transaksi->pesanan->idPesanan : '-' }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    {{ $transaksi->reservasi ? $transaksi->reservasi->idReservasi : '-' }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    @if ($transaksi->pesanan)
                                        {{ $transaksi->pesanan->user->name }}
                                    @elseif($transaksi->reservasi)
                                        {{ $transaksi->reservasi->nama_depan }}
                                        {{ $transaksi->reservasi->nama_belakang }}
                                    @endif
                                </td>
                                <td class="border-t px-4 py-4">
                                    {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y') }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    @if ($transaksi->pesanan)
                                        Rp {{ number_format($transaksi->pesanan->calculateTotal(), 0, ',', '.') }}
                                    @elseif($transaksi->reservasi)
                                        Rp {{ number_format($transaksi->totalPembayaran, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="border-t px-4 py-4">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full font-medium
                                        {{ $transaksi->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $transaksi->status === 'dibayar' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $transaksi->status === 'diverifikasi' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $transaksi->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                </td>
                                {{-- <td class="border-t px-4 py-4">
                                    @if ($transaksi->pesanan)
                                        @if ($transaksi->pesanan->tipePesanan === 'delivery')
                                            <span class="text-gray-600">
                                                {{ $transaksi->pesanan->pengiriman->alamat ?? 'Belum ada alamat' }}
                                            </span>
                                        @else
                                            <span class="text-gray-600">Pickup</span>
                                        @endif
                                    @else
                                        @if ($transaksi->reservasi && $transaksi->reservasi->bukti_pembayaran)
                                            <a href="#"
                                                onclick="showBukti('{{ Storage::url($transaksi->reservasi->bukti_pembayaran) }}')"
                                                class="text-blue-600 hover:text-blue-900">
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-gray-500">Belum ada bukti</span>
                                        @endif
                                    @endif
                                </td> --}}
                                <td class="border-t px-4 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.transaksi.edit', $transaksi) }}"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.transaksi.destroy', $transaksi) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="buktiModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white dark:bg-boxdark rounded-sm text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-boxdark px-5 pt-6 pb-2.5 sm:px-7.5 sm:pt-7.5">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-black dark:text-white" id="modal-title">
                                    Bukti Pembayaran
                                </h3>
                                <div class="mt-4">
                                    @foreach ($transaksis as $transaksi)
                                        @if ($transaksi->fotoBukti)
                                            <div class="mb-6">
                                                <div class="border border-stroke dark:border-strokedark rounded-sm p-4">
                                                    <img id="buktiImage"
                                                        src="{{ Storage::url($transaksi->fotoBukti) }}"
                                                        alt="{{ $transaksi->idTransaksi }}"
                                                        class="max-w-full mx-auto rounded-sm shadow">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-meta-4 px-5 py-3 sm:px-7.5 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-sm border border-stroke dark:border-strokedark shadow-sm px-4 py-2 bg-white dark:bg-boxdark text-base font-medium text-black dark:text-white hover:bg-gray-50 dark:hover:bg-meta-4 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm"
                            onclick="closeModal()">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail Modal -->
        {{-- <div id="detailModal" class="fixed inset-0 bg-black/50 dark:bg-black/60 hidden items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-8 max-w-2xl w-full mx-4 shadow-lg dark:shadow-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Reservasi</h2>
                    <button onclick="closeModal()"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="detailContent" class="space-y-4 text-gray-800 dark:text-gray-200">
                    <!-- Detail content will be injected here -->
                </div>
            </div>
        </div> --}}
    </div>
</x-admin-layout>
