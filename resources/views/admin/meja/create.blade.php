<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Tambah Meja Baru
                </h3>
            </div>
            <form action="{{ route('admin.meja.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-5.5 p-6.5">
                    <div>
                        <label for="nama" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama
                        </label>
                        <input type="text" name="nama" id="nama" placeholder="Nama"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            value="{{ old('nama') }}" required />
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jumlahPengunjung" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Kapasitas
                        </label>
                        <input type="number" name="jumlahPengunjung" id="jumlahPengunjung" placeholder="Kapasitas"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            value="{{ old('jumlahPengunjung') }}" required />
                        @error('jumlahPengunjung')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Status
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                            <select name="status" required
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white">
                                <option value="" disabled selected>Pilih Status</option>
                                @foreach ($statusOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 z-10 -translate-y-1/2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.8">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                            fill="#637381"></path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label for="lokasi" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Lokasi
                        </label>
                        <input type="text" name="lokasi" id="lokasi" placeholder="Lokasi"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            value="{{ old('lokasi') }}" required />
                        @error('lokasi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <a href="{{ route('admin.meja.index') }}"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Kembali
                            </a>
                        </div>
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Buat Meja
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
