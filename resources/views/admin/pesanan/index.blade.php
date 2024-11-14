<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Pesanan
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li class="font-medium">
                        {{ Auth::user()->role === 'owner' ? 'Owner' : 'Admin' }} /
                        {{-- <a class="font-medium" href="index.html">Menu /</a> --}}
                    </li>
                    <li class="text-primary">Pesanan</li>
                </ol>
            </nav>
        </div>
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
                            <th class="px-4 py-4 font-medium text-black dark:text-white">No</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Nama</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Tipe Pesanan</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Item Pesanan</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Status</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $index => $pesanan)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                <td class="border-t px-4 py-4">
                                    {{ $pesanans->firstItem() + $index }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    {{ $pesanan->user->name }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    {{ ucfirst($pesanan->tipePesanan) }}
                                </td>
                                <td class="border-t px-4 py-4">
                                    <ul class="list-disc list-inside">
                                        @foreach ($pesanan->itemPesanan as $item)
                                            <li>{{ $item->menu->nama }} ({{ $item->jumlah }}x)</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border-t px-4 py-4">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full font-medium
                                        {{ $pesanan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $pesanan->status === 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $pesanan->status === 'dikirim' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                        {{ $pesanan->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $pesanan->status === 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($pesanan->status) }}
                                    </span>
                                </td>
                                <td class="border-t px-4 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.pesanan.show', $pesanan->idPesanan) }}"
                                            class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.pesanan.edit', $pesanan->idPesanan) }}"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.pesanan.destroy', $pesanan->idPesanan) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
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

        <div class="mt-4">
            {{ $pesanans->links() }}
        </div>
    </div>
</x-admin-layout>
