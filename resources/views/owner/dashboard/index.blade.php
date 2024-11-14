<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Dashboard
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li class="font-medium">
                        Admin /
                        {{-- <a class="font-medium" href="index.html">Menu /</a> --}}
                    </li>
                    <li class="text-primary">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">

            <!-- Card untuk Detail Menu -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2zm0 2v16h12V4H6zm2 4h8v2H8V8zm0 4h8v2H8v-2z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">{{ $totalDetailMenus }}</h4>
                        <span class="text-sm font-medium">Total Detail Menu</span>
                    </div>
                </div>
            </div>

            <!-- Card untuk Menu -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 4h18a1 1 0 011 1v14a1 1 0 01-1 1H3a1 1 0 01-1-1V5a1 1 0 011-1zm17 4H4v10h16V8zm-5-3h4v2h-4V5zM2 9h2v6H2V9zm18 0h2v6h-2V9z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">{{ $totalMenus }}</h4>
                        <span class="text-sm font-medium">Total Menu</span>
                    </div>
                </div>
            </div>

            <!-- Card untuk Meja -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 6h16v4h2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v4h2V6zm14 10H6v-3H4v3a2 2 0 002 2h12a2 2 0 002-2v-3h-2v3zM3 10h18v2H3v-2z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">{{ $totalMejas }}</h4>
                        <span class="text-sm font-medium">Total Meja</span>
                    </div>
                </div>
            </div>

            <!-- Card untuk Reservasi -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 3h4a1 1 0 011 1v16a1 1 0 01-1 1H3a1 1 0 01-1-1V4a1 1 0 011-1h4V1h2v2h6V1h2v2zm3 8H4v8h16v-8zm0-6H4v4h16V5z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">{{ $totalReservasis }}</h4>
                        <span class="text-sm font-medium">Total Reservasi</span>
                    </div>
                </div>
            </div>

            <!-- Card untuk Pesanan -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7 8V6a5 5 0 0110 0v2h3a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V9a1 1 0 011-1h3zm0 2H5v10h14V10h-2v2h-2v-2H9v2H7v-2zm2-2h6V6a3 3 0 00-6 0v2z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">{{ $totalPesanans }}</h4>
                        <span class="text-sm font-medium">Total Pesanan</span>
                    </div>
                </div>
            </div>

            <!-- Card untuk Transaksi -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 4h-2V2H4v2H2v18h20V4zM6 4h12v2H6V4zm14 16H4V8h16v12zm-13-7h10v2H7v-2z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">{{ $totalTransaksis }}</h4> <span
                            class="text-sm font-medium">Total Transaksi</span>
                    </div>
                </div>
            </div>

            <!-- Card untuk Total Pendapatan -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"
                            fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">Rp
                            {{ number_format($totalPembayaran, 0, ',', '.') }}</h4>
                        <span class="text-sm font-medium">Total Pendapatan</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
