<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
            <a href="{{ route('admin.reservasi.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                Tambah Reservasi
            </a>
        </div>

        <!-- Main Table -->
        <div
            class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-left dark:bg-meta-4">
                            <th class="px-4 py-4 font-medium text-black dark:text-white">No</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Nama</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Meja</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Tanggal</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Status</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasis as $index => $reservasi)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                <td class="border-t px-4 py-4">{{ $index + 1 }}</td>
                                <td class="border-t px-4 py-4">
                                    {{ $reservasi->nama_depan }} {{ $reservasi->nama_belakang }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    @if ($reservasi->meja)
                                        {{ $reservasi->meja->nama }} (Kapasitas
                                        {{ $reservasi->meja->jumlahPengunjung }})
                                    @else
                                        <span class="text-gray-400">Tidak tersedia</span>
                                    @endif
                                </td>
                                <td class="border-t px-4 py-4">
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d/m/Y H:i') }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full font-medium
                                    {{ $reservasi->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $reservasi->status === 'dikonfirmasi' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $reservasi->status === 'selesai' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $reservasi->status === 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($reservasi->status) }}
                                    </span>
                                </td>
                                <td class="border-t px-4 py-4">
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="showDetail({{ $reservasi->idReservasi }})"
                                            class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </button>
                                        <a href="{{ route('admin.reservasi.edit', $reservasi->idReservasi) }}"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.reservasi.destroy', $reservasi->idReservasi) }}"
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

        <!-- Detail Modal -->
        <div id="detailModal" class="fixed inset-0 bg-black/50 dark:bg-black/60 hidden items-center justify-center">
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
        </div>

    </div>
</x-admin-layout>
