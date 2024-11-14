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
                        <a class="font-medium" href="{{ route('admin.detail.index') }}">Detail Menu /</a>
                    </li>
                    <li class="text-primary">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Edit Detail Menu
                </h3>
            </div>
            <form action="{{ route('admin.detail.update', $detailMenu->idDetailMenu) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-5.5 p-6.5">
                    <div>
                        <label for="nama" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama
                        </label>
                        <input type="text" name="nama" id="nama" placeholder="Nama"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            value="{{ old('nama', $detailMenu->nama) }}" required />
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="6" placeholder="Deskripsi"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required>{{ old('deskripsi', $detailMenu->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gambar" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Gambar
                        </label>
                        <input type="file" name="gambar" id="gambar"
                            class="w-full rounded-md border border-stroke p-3 outline-none transition file:mr-4 file:rounded file:border-[0.5px] file:border-stroke file:bg-[#EEEEEE] file:px-2.5 file:py-1 file:text-sm file:font-normal focus:border-primary file:focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-strokedark dark:file:bg-white/30 dark:file:text-white" />
                        @if ($detailMenu->gambar)
                            <div class="mt-2">
                                <img src="{{ Storage::url($detailMenu->gambar) }}" alt="Current image"
                                    class="w-32 h-32 object-cover">
                            </div>
                        @endif
                        @error('gambar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Harga
                        </label>
                        <input type="number" name="harga" id="harga" placeholder="Harga" step="0.01"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            value="{{ old('harga', $detailMenu->harga) }}" required />
                        @error('harga')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <a href="{{ route('admin.detail.index') }}"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Kembali
                            </a>
                        </div>
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Update Menu
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
