<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Detail Menu
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li class="font-medium">
                        Admin /
                        {{-- <a class="font-medium" href="index.html">Menu /</a> --}}
                    </li>
                    <li class="text-primary">Detail Menu</li>
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
        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
            <a href="{{ route('admin.detail.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                Tambah Detail Menu
            </a>
        </div>
        <div
            class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-left dark:bg-meta-4">
                            <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                                Nama
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                Deskripsi
                            </th>
                            <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                Image
                            </th>
                            <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                Price
                            </th>
                            <th class="px-4 py-4 font-medium text-black dark:text-white">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                <td class="border-b border-[#eee] px-4 py-5 pl-3 dark:border-strokedark xl:pl-11">
                                    <p class="text-black dark:text-white">{{ $menu->nama }}</p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-4 dark:border-strokedark">
                                    <p class="text-black dark:text-white">{{ Str::limit($menu->deskripsi, 50) }}</p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-4 dark:border-strokedark">
                                    <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama }}"
                                        class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-4 dark:border-strokedark">
                                    <p class="text-black dark:text-white">{{ number_format($menu->harga, 2) }}</p>
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-2 dark:border-strokedark">
                                    <a href="{{ route('admin.detail.edit', $menu) }}"
                                        class="inline-flex items-center justify-center rounded-md bg-yellow-500 px-4 py-2 text-center font-medium text-white hover:bg-yellow-600 transition duration-300 mr-2"
                                        title="Edit Menu">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.detail.destroy', $menu) }}" method="POST"
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
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
