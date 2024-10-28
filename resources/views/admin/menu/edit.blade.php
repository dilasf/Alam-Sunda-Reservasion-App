<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Edit Paket
                </h3>
            </div>
            <form action="{{ route('admin.menu.update', $menu->idMenu) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-5.5 p-6.5">
                    <div>
                        <label for="nama" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama
                        </label>
                        <input type="text" name="nama" id="nama" placeholder="Nama"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $menu->nama) }}"
                            required />
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="gambar" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Gambar
                        </label>
                        <input type="file" name="gambar" id="gambar"
                            class="w-full rounded-md border border-stroke p-3 outline-none transition file:mr-4 file:rounded file:border-[0.5px] file:border-stroke file:bg-[#EEEEEE] file:px-2.5 file:py-1 file:text-sm file:font-normal focus:border-primary file:focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-strokedark dark:file:bg-white/30 dark:file:text-white" />
                        @if ($menu->gambar)
                            <div class="mt-2">
                                <img src="{{ Storage::url($menu->gambar) }}" alt="Current image"
                                    class="w-32 h-32 object-cover">
                            </div>
                        @endif
                        @error('gambar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="detail menu" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Detail Menu
                        </label>
                        @foreach ($detailMenus as $detail)
                            <div class="mb-3" x-data="{ checkboxToggle: {{ in_array($detail->idDetailMenu, old('detail_menus', $menu->detailMenus->pluck('idDetailMenu')->toArray())) ? 'true' : 'false' }} }">
                                <label for="detail{{ $detail->idDetailMenu }}"
                                    class="flex cursor-pointer select-none items-center text-sm font-medium">
                                    <div class="relative">
                                        <input type="checkbox" id="detail{{ $detail->idDetailMenu }}" class="sr-only"
                                            name="detail_menus[]" value="{{ $detail->idDetailMenu }}"
                                            @change="checkboxToggle = !checkboxToggle" :checked="checkboxToggle" />
                                        <div :class="checkboxToggle ? 'border-primary bg-gray dark:bg-transparent' : 'border'"
                                            class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                            <span :class="checkboxToggle ? '!opacity-100' : 'opacity-0'"
                                                class="transition-opacity duration-200">
                                                <svg width="11" height="8" viewBox="0 0 11 8" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z"
                                                        fill="#3056D3" stroke="#3056D3" stroke-width="0.4"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    {{ $detail->nama }} (Rp {{ number_format($detail->harga, 2) }})
                                </label>
                            </div>
                        @endforeach
                        @error('detail_menus')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <a href="{{ route('admin.menu.index') }}"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Kembali
                            </a>
                        </div>
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Buat Menu
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
