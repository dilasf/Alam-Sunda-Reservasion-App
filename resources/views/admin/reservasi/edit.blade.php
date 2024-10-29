<x-admin-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Edit Reservasi
                </h3>
            </div>
            <form action="{{ route('admin.reservasi.update', $reservasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-5.5 p-6.5">
                    <div>
                        <label for="nama_depan" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama Depan
                        </label>
                        <input
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            type="text" class="form-control @error('nama_depan') is-invalid @enderror"
                            id="nama_depan" name="nama_depan" value="{{ old('nama_depan', $reservasi->nama_depan) }}"
                            required />
                        @error('nama_depan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_belakang" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Nama Belakang
                        </label>
                        <input
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            type="text" class="form-control @error('nama_belakang') is-invalid @enderror"
                            id="nama_belakang" name="nama_belakang"
                            value="{{ old('nama_belakang', $reservasi->nama_belakang) }}" required />
                        @error('nama_belakang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Email
                        </label>
                        <input
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $reservasi->email) }}" required />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="no_telepon" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            No Telepon
                        </label>
                        <input
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                            id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $reservasi->no_telepon) }}"
                            required />
                        @error('no_telepon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="idMeja" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Meja
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                            <select id="idMeja" name="idMeja" required
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white @error('idMeja') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Meja</option>
                                @foreach ($mejas as $meja)
                                    <option value="{{ $meja->idMeja }}"
                                        {{ old('idMeja', $reservasi->idMeja) == $meja->idMeja ? 'selected' : '' }}>
                                        Meja {{ $meja->idMeja }} (Kapasitas: {{ $meja->jumlahPengunjung }})
                                    </option>
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
                            @error('idMeja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="tanggal">
                            Tanggal Reservasi
                        </label>
                        <div class="relative">
                            <input type="text" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', $reservasi->tanggal) }}" required
                                class="w-full rounded border-[1.5px] bg-transparent px-5 py-3 font-normal outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary dark:text-white @error('tanggal') border-red-500 @enderror"
                                placeholder="Pilih Tanggal dan Waktu" />

                            <div class="pointer-events-none absolute inset-0 left-auto right-5 flex items-center">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="..." class="fill-current text-gray-500 dark:text-white" />
                                </svg>
                            </div>
                        </div>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jumlahPengunjung" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Jumlah Pengunjung
                        </label>
                        <input type="number" name="jumlahPengunjung" id="jumlahPengunjung" placeholder="Kapasitas"
                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            value="{{ old('jumlahPengunjung', $reservasi->jumlahPengunjung) }}" required />
                        @error('jumlahPengunjung')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Status
                        </label>
                        <div class="relative z-20 bg-white dark:bg-form-input">
                            <select id="status" name="status" required
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white @error('status') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="pending"
                                    {{ old('status', $reservasi->status) == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="dikonfirmasi"
                                    {{ old('status', $reservasi->status) == 'dikonfirmasi' ? 'selected' : '' }}>
                                    Dikonfirmasi
                                </option>
                                <option value="selesai"
                                    {{ old('status', $reservasi->status) == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="dibatalkan"
                                    {{ old('status', $reservasi->status) == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
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
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <a href="{{ route('admin.reservasi.index') }}"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Kembali
                            </a>
                        </div>
                        <div class="mb-4 flex flex-wrap gap-5 xl:gap-20">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 transition duration-300">
                                Ubah Reservasi
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
