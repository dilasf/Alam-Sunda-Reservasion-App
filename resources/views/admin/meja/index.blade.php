<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
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
        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
            <a href="{{ route('admin.meja.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                Tambah Meja
            </a>
        </div>
        <div
            class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-left dark:bg-meta-4">
                            <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">Nama
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">Kapasitas</th>
                            <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">Status</th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">Lokasi</th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mejas as $meja)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                <td class="border-b border-[#eee] px-4 py-5 pl-3 dark:border-strokedark xl:pl-11">
                                    <p class="text-black dark:text-white">{{ $meja->nama }}</p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-4 dark:border-strokedark">
                                    <p class="text-black dark:text-white">{{ $meja->jumlahPengunjung }} Orang</p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-2 dark:border-strokedark">
                                    <p class="text-black dark:text-white">
                                        <span
                                            class="inline-flex rounded-full {{ $meja->status === 'Tersedia' ? 'bg-success bg-opacity-10 px-3 py-1 text-sm font-medium text-success' : 'bg-danger bg-opacity-10 px-3 py-1 text-sm font-medium text-danger' }}">
                                            {{ $meja->status }}
                                        </span>
                                    </p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-4 dark:border-strokedark">
                                    <p class="text-black dark:text-white">{{ $meja->lokasi }}</p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-2 dark:border-strokedark">
                                    <a href="{{ route('admin.meja.edit', $meja->idMeja) }}"
                                        class="inline-flex items-center justify-center rounded-md bg-yellow-500 px-4 py-2 text-center font-medium text-white hover:bg-yellow-600 transition duration-300 mr-2"
                                        title="Edit Menu">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.meja.destroy', $meja->idMeja) }}" method="POST"
                                        class="inline-flex items-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-md bg-red-500 px-4 py-2 text-center font-medium text-white hover:bg-red-600 transition duration-300"
                                            onclick="return confirm('Are you sure?')" title="Delete Menu">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
