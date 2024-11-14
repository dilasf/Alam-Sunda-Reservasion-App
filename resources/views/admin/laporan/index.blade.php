<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Laporan
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li class="font-medium">
                        {{ Auth::user()->role === 'owner' ? 'Owner' : 'Admin' }} /
                        {{-- <a class="font-medium" href="index.html">Menu /</a> --}}
                    </li>
                    <li class="text-primary">Laporan</li>
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

        <div
            class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            {{-- <h2 class="text-2xl font-semibold text-black dark:text-white mb-6">Laporan Transaksi</h2> --}}

            <form action="{{ route('admin.laporan.generate') }}" method="GET">
                <div class="mb-6">
                    <div>
                        <label for="report_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Jenis Laporan
                        </label>
                        <select name="report_type" id="report_type" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                            <option value="">Pilih Jenis Laporan</option>
                            <option value="reservasi">Laporan Reservasi</option>
                            <option value="pesanan">Laporan Pesanan</option>
                        </select>
                    </div>


                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tanggal Mulai
                        </label>
                        <input type="date" name="start_date" id="start_date" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    </div>

                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tanggal Akhir
                        </label>
                        <input type="date" name="end_date" id="end_date" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    </div>
                </div>

                <div class="flex justify-end mb-6">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
