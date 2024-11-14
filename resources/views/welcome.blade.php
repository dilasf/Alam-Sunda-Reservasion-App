<x-guest-layout>
    <!-- Main Hero Content -->
    <div class="container max-w-lg px-4 py-70 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center relative font-['Inter',sans-serif]"
        style="background-image: url('{{ asset('src/images/cover/cover_welcome.jpg') }}')">
        <!-- Black overlay with blur -->
        <div class="absolute inset-0 bg-[#151518] bg-opacity-90 backdrop-blur-sm"></div>

        <!-- Content (now relative to appear above the overlay) -->
        <div class="relative z-10 flex flex-col items-center">
            <h1
                class="font-['Inter',sans-serif] text-3xl bg-clip-text bg-gradient-to-r text-[#E0C48B] md:text-center sm:leading-none lg:text-5xl leading-relaxed pb-2">
                <!-- Ditambahkan leading-relaxed dan pb-2 -->
                <span class="inline md:block">Selamat Datang Di Alam Sunda Cipayung</span>
            </h1>
            <div class="mx-auto mt-2 text-white md:text-center lg:text-lg">
                Nikmati Masakan Khas Sunda Bersama Kami
            </div>
            <div class="flex flex-col mt-10 sm:flex-row items-center justify-center gap-4">
                <a href="#reservasi"
                    class="w-full sm:w-auto px-4 py-3 text-[#E0C48B] border-2 border-[#E0C48B] hover:bg-[#E0C48B] hover:text-gray-900 transition-all duration-300 text-lg font-medium">
                    Reservasi Sekarang
                </a>
                <a href="#menu"
                    class="w-full sm:w-auto px-4 py-3 text-[#E0C48B] border-2 border-[#E0C48B] hover:bg-[#E0C48B] hover:text-gray-900 transition-all duration-300 text-lg font-medium">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
    <!-- End Main Hero Content -->
    <section class="px-2 py-32 bg-gradient-to-b min-h-screen from-[#1f1f22] to-[#151518] md:px-0">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2">
                <div class="text-center font-['Inter',sans-serif] ">
                    <h2 class="text-[#E0C48B] text-sm uppercase tracking-widest mb-2">
                        Tentang Kami
                    </h2>
                    <h1 class="text-5xl mb-6 text-white">
                        Warung Nasi
                        <br />
                        Alam Sunda
                    </h1>
                    <p class="text-white mb-6 mx-30 text-sm">
                        Warung Nasi Alam Sunda pertama kali berdiri dan dirintis pada tahun 2003 di Tanah Abang jakarta,
                        berawal dari warung kaki lima hingga akhirnya pada tahun 2006. Pada tahun 2013 mencoba membuka
                        cabang Warung Nasi Alam Sunda di kota
                        kelahiran yaitu Kabupaten Cianjur dan cukupberkembang dengan cepat sehingga pada tahun 2019
                        telah berkembang menjadi 13 (tiga belas) Cabang.
                    </p>
                    <p class="text-md  mb-2 text-white">
                        Reservasi Melalui Telepon
                    </p>
                    <p class="text-[#E0C48B] text-md mb-6">
                        +62 812-2397-8735
                    </p>
                    <span class="relative inline-flex w-full md:w-auto md:mr-4 mb-4 md:mb-0">
                        <a href="#_" type="button"
                            class="w-full sm:w-auto px-4 py-3 text-sm text-[#E0C48B] border-2 border-[#E0C48B] hover:bg-[#E0C48B] hover:text-gray-900 transition-all duration-300 font-medium">
                            Reservasi Sekarang
                        </a>
                    </span>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center md:justify-end mt-8 md:mt-0 relative">
                <img alt="Restaurant interior with people dining" class=" shadow-lg" height="600"
                    src="{{ asset('src/images/cover/alsun.jpg') }}" width="600" />
                <img alt="Chef preparing a dish"
                    class="absolute bottom-0 left-18 top-48 transform -translate-x-1/2 translate-y-1/4 shadow-lg"
                    height="200" width="100" src="{{ asset('src/images/cover/img-pattern.svg') }}" />
                <img alt="Chef preparing a dish"
                    class="absolute bottom-0 left-18 transform -translate-x-1/2 translate-y-1/4 shadow-lg"
                    height="400" width="200" src="{{ asset('src/images/cover/tengkeleng2.png') }}" />
            </div>
        </div>
    </section>
    <section class="bg-[#1f1f22] h-screen flex items-center"
        style="
    background-color: #151516;
    background-image: url('{{ asset('src/images/cover/shape-2.png') }}');
    background-repeat: no-repeat;
    background-size: 25% auto;
    background-position: top right;
">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="mb-30">
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-xl mb-3 text-[#E0C48B]">
                            Fasilitas & Layanan
                        </h1>
                        <div class="flex justify-center mb-3">
                            <img class="" src="{{ asset('src/images/cover/separator.svg') }}" alt=""
                                width="95">
                        </div>
                        <p class="text-[#E0C48B]">
                            Warung Nasi Alam Sunda
                        </p>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4 place-items-center">
                <!-- Feature 1 -->
                <div class="relative">
                    <div
                        class="flex flex-col items-center justify-center text-center p-6 bg-[#1f1f22] shadow-md hover:shadow-lg w-[250px] h-[250px] hover:scale-110 transition-transform duration-300 ease-in-out">
                        <img src="{{ asset('src/images/cover/fasilitas.png') }}" alt="Traditional house and bowl icon"
                            class="mb-4 h-24 w-24" />
                        <p class="text-lg font-semibold text-[#E0C48B]">
                            Fasilitas
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="relative">
                    <div
                        class="flex flex-col items-center justify-center text-center p-6 bg-[#111111] shadow-md hover:shadow-lg w-[250px] h-[250px] hover:scale-110 transition-transform duration-300 ease-in-out">
                        <img src="{{ asset('src/images/cover/higienis.png') }}" alt="Bowl of fresh vegetables icon"
                            class="mb-4 h-24 w-24" />
                        <p class="text-lg font-semibold text-[#E0C48B]">
                            Higienis, Bersih & Segar
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="relative">
                    <div
                        class="flex flex-col items-center justify-center text-center p-6 bg-[#1f1f22] shadow-md hover:shadow-lg w-[250px] h-[250px] hover:scale-110 transition-transform duration-300 ease-in-out">
                        <img src="{{ asset('src/images/cover/halal.png') }}" alt="Halal certification icon"
                            class="mb-4 h-24 w-24" />
                        <p class="text-lg font-semibold text-[#E0C48B]">
                            Berlandaskan Nilai Islami
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="relative">
                    <div
                        class="flex flex-col items-center justify-center text-center p-6 bg-[#111111] shadow-md hover:shadow-lg w-[250px] h-[250px] hover:scale-110 transition-transform duration-300 ease-in-out">
                        <img src="{{ asset('src/images/cover/gratis.png') }}" alt="Free items promotion icon"
                            class="mb-4 h-24 w-24" />
                        <p class="text-lg font-semibold text-[#E0C48B]">
                            Banyak Gratisnya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-4 pb-12 min-h-screen flex flex-col items-center justify-center font-['Inter',sans-serif] "
        style="
        background-color: #141416;
        background-image: url('{{ asset('src/images/cover/shape-5.png') }}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: left;
        background-size: 60% auto;
    ">
        <div class="container mx-auto px-4">
            <h1 class="text-center text-1xl text-[#E0C48B] mb-2">
                PAKET RECOMENDASI
            </h1>
            <div class="flex justify-center mb-15">
                <img class="" src="{{ asset('src/images/cover/separator.svg') }}" alt="" width="100">
            </div>
            <h1 class="text-center text-4xl text-white mb-15">
                Paket Nasi Box
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @foreach ($menus->take(6) as $menu)
                    <div class="flex items-start space-x-4 pb-4 border-b border-gray-700">
                        <!-- Debug info -->
                        @php
                            // Uncomment baris di bawah untuk debugging
                            // dd($menu->detailMenus);
                        @endphp

                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                            class="w-[60px] h-[60px] rounded-lg object-cover flex-shrink-0">

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg truncate text-white">
                                    {{ $menu->nama }}
                                </h3>
                                <div class="text-sm text-[#E0C48B] ml-2 flex-shrink-0">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </div>
                            </div>
                            <p class="text-sm text-gray-400 mt-1 line-clamp-2">
                                @if ($menu->detailMenus->isNotEmpty())
                                    {{ $menu->detailMenus->pluck('nama')->implode(', ') }}
                                @else
                                    Tidak ada detail
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <p class="text-sm text-gray-400">
                    Warung buka pada pukul
                    <span class="font-bold">10:00 am</span> sampai
                    <span class="font-bold">9:00 am</span>
                </p>
                <button
                    class="w-full mt-4 sm:w-auto px-4 py-3 text-sm text-[#E0C48B] border-2 border-[#E0C48B] hover:bg-[#E0C48B] hover:text-gray-900 transition-all duration-300 font-medium">
                    <a href="#">PESAN SEKARANG</a>
                </button>
            </div>
        </div>
    </section>
    <section class="pt-12 pb-12 bg-gradient-to-r min-h-screen from-[#1f1f22] to-[#151518] font-['Inter',sans-serif]">
        <div class="container mx-auto p-6 sm:p-12 md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Reservasi Online (Bagian Kiri) -->
                <div class="md:col-span-2 bg-[#0D0D0B] shadow-lg p-8">
                    <h1 class="text-6xl mb-4 text-white text-center">Reservasi Online</h1>
                    <p class="text-sm mb-6 text-white text-center">
                        Permintaan Reservasi <span class="text-[#E0C48B]">+62 812-2397-8735</span> atau isi Form ini
                    </p>
                    @if ($errors->any())
                        <div class="p-4 mb-4 bg-red-100 border border-red-400 text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 bg-red-100 border border-red-400 text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('frontend.reservasi.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input type="text" name="nama_depan" placeholder="Nama Depan"
                                value="{{ old('nama_depan') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all @error('nama_depan') border-red-500 @enderror"
                                required>
                            <input type="text" name="nama_belakang" placeholder="Nama Belakang"
                                value="{{ old('nama_belakang') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all @error('nama_belakang') border-red-500 @enderror"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all @error('email') border-red-500 @enderror"
                                required>
                            <input type="text" name="no_telepon" placeholder="Nomor Telepon"
                                value="{{ old('no_telepon') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all @error('no_telepon') border-red-500 @enderror"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <select name="jumlahPengunjung"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all @error('jumlahPengunjung') border-red-500 @enderror"
                                required>
                                <option class="text-gray-400" value="">Jumlah Pengunjung</option>
                                <option value="1" {{ old('jumlahPengunjung') == '1' ? 'selected' : '' }}>1 Orang
                                </option>
                                <option value="2" {{ old('jumlahPengunjung') == '2' ? 'selected' : '' }}>2 Orang
                                </option>
                                <option value="3" {{ old('jumlahPengunjung') == '3' ? 'selected' : '' }}>3 Orang
                                </option>
                                <option value="4" {{ old('jumlahPengunjung') == '4' ? 'selected' : '' }}>4 Orang
                                </option>
                                <option value="5" {{ old('jumlahPengunjung') == '5' ? 'selected' : '' }}>5 Orang
                                </option>
                                <option value="6" {{ old('jumlahPengunjung') == '6' ? 'selected' : '' }}>6 Orang
                                </option>
                            </select>
                            <input type="datetime-local" name="tanggal" placeholder="Tanggal dan Waktu"
                                value="{{ old('tanggal', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert-[0.4] @error('tanggal') border-red-500 @enderror"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                            <select name="idMeja"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white focus:ring-2 focus:ring-[#FFE077] focus:border-[#FFE077] focus:outline-none transition-all @error('idMeja') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Meja</option>
                                @foreach ($mejas as $meja)
                                    <option value="{{ $meja->idMeja }}"
                                        {{ old('idMeja') == $meja->idMeja ? 'selected' : '' }}>
                                        Meja {{ $meja->idMeja }} (Kapasitas: {{ $meja->jumlahPengunjung }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full p-3 bg-[#FFE077] text-black font-bold hover:bg-[#b69b41] transition-all">
                            BUAT RESERVASI
                        </button>
                    </form>
                </div>

                <!-- Contact Us (Bagian Kanan) -->
                <div class="bg-no-repeat bg-cover bg-center p-8 h-full text-center font-['Inter',sans-serif]"
                    style="background-image: url('{{ asset('src/images/cover/form-pattern.png') }}')">
                    <h1 class="text-4xl mb-6 text-white">Hubungi Kami</h1>
                    <p class="text-lg mb-4 text-white">
                        Permintaan Reservasi <span class="text-[#E0C48B]">+62 812-2397-8735</span>
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-md mb-4 text-white">
                        <strong>Lokasi</strong><br>
                        Jl. Raya Puncak - Gadog No.239, Kec. Megamendung, Kabupaten Bogor, Jawa Barat
                        16770
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-md mb-4 text-white">
                        <strong>Jam Buka</strong><br>
                        Senin sampai Minggu<br>
                        09.00 am - 09.00pm
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
