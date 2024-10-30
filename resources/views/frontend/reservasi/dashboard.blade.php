<x-guest-layout>
    <!-- Main Hero Content -->
    <div class="container max-w-lg px-4 py-50 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center relative"
        style="background-image: url('{{ asset('src/images/cover/cover_welcome.jpg') }}')">
        <!-- Black overlay with blur -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

        <!-- Content (now relative to appear above the overlay) -->
        <div class="relative z-10">
            <h1
                class="font-mono text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-500 md:text-center sm:leading-none lg:text-5xl leading-relaxed pb-2">
                <!-- Ditambahkan leading-relaxed dan pb-2 -->
                <span class="inline md:block">Selamat Datang Di Alam Sunda Cipayung</span>
            </h1>
            <div class="mx-auto mt-2 text-green-50 md:text-center lg:text-lg">
                Nikmati Masakan Khas Sunda Bersama Kami
            </div>
            <div class="flex flex-col items-center mt-12 text-center">
                <span class="relative inline-flex w-full md:w-auto">
                    <a href="#_" type="button"
                        class="inline-flex items-center justify-center px-6 py-2 text-base font-bold leading-6 text-white bg-green-600 rounded-full lg:w-full md:w-auto hover:bg-green-500 focus:outline-none">
                        Reservasi Sekarang
                    </a>
                </span>
            </div>
        </div>
    </div>
    <!-- End Main Hero Content -->
    <section class="px-2 py-32 bg-white md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pr-0 md:pb-0">
                        <!-- <h1
        class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl"
      > -->
                        <h3 class="text-xl">OUR STORY
                        </h3>
                        <h2 class="text-4xl text-green-600">Welcome</h2>
                        <!-- </h1> -->
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus nemo incidunt
                            praesentium, ipsum
                            culpa minus eveniet, id nesciunt excepturi sit voluptate repudiandae. Explicabo, incidunt
                            quia.
                            Repellendus mollitia quaerat est voluptas!
                        </p>
                        <div class="relative flex">
                            <a href="#_"
                                class="flex items-center w-full px-6 py-3 mb-3 text-lg text-white bg-green-600 rounded-md sm:mb-0 hover:bg-green-700 sm:w-auto">
                                Read More
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                        <img src="https://cdn.pixabay.com/photo/2017/08/03/13/30/people-2576336_960_720.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="container items-center max-w-6xl px-4 px-10 mx-auto sm:px-20 md:px-32 lg:px-16">
            <div class="flex flex-wrap items-center -mx-3">
                <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
                    <div class="w-full lg:max-w-md">
                        <h2 class="mb-4 text-2xl font-bold">About Us</h2>
                        <h2
                            class="mb-4 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                            WHY CHOOSE US?</h2>

                        <p class="mb-4 font-medium tracking-tight text-gray-400 xl:mb-6">Lorem ipsum dolor sit amet
                            consectetur
                            adipisicing elit. Natus hic atque magni minus aliquam, eos quam incidunt nam iusto sunt
                            voluptates
                            inventore a veritatis doloremque corrupti. Veritatis est expedita cupiditate!</p>
                        <ul>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-500">Faster Processing and Delivery</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-gray-500">Easy Payments</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-500">100% Protection and Security for Your App</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><img
                        class="mx-auto sm:max-w-sm lg:max-w-full"
                        src="https://cdn.pixabay.com/photo/2020/12/31/12/28/cook-5876388_960_720.png"
                        alt="feature image"></div>
            </div>
        </div>
    </section>
    <section class="mt-8 bg-white">
        <div class="mt-4 text-center">
            <h3 class="text-2xl font-bold">Our Menu</h3>
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                TODAY'S SPECIALITY</h2>
        </div>
        <div class="container w-full px-5 py-6 mx-auto">
            <div class="grid lg:grid-cols-4 gap-y-6">
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48"
                        src="https://cdn.pixabay.com/photo/2014/11/05/15/57/salmon-518032_960_720.jpg" alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">Seafood</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">salmon fish 1
                            seafood</h4>
                        <p class="leading-normal text-gray-700">Lorem ipsum dolor, sit amet cons ectetur adipis icing
                            elit.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <button class="px-4 py-2 bg-green-600 text-green-50">Order Now</button>
                        <span class="text-xl text-green-600">$20.0</span>
                    </div>
                </div>
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48"
                        src="https://cdn.pixabay.com/photo/2010/12/13/10/25/canape-2802_960_720.jpg" alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="px-4 py-0.5 text-sm bg-pink-500 rounded-full text-pink-50">Seafood</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">salmon fish 2
                            seafood</h4>
                        <p class="leading-normal text-gray-700">Lorem ipsum dolor, sit amet cons ectetur adipis icing
                            elit.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <button class="px-4 py-2 bg-green-600 text-green-50">Order Now</button>
                        <span class="text-xl text-green-600">$40.12</span>
                    </div>
                </div>

                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48"
                        src="https://cdn.pixabay.com/photo/2015/04/08/13/13/food-712665_960_720.jpg" alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">Seafood</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">salmon fish 3
                            seafood</h4>
                        <p class="leading-normal text-gray-700">Lorem ipsum dolor, sit amet cons ectetur adipis icing
                            elit.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <button class="px-4 py-2 bg-green-600 text-green-50">Order Now</button>
                        <span class="text-xl text-green-600">$50.12</span>
                    </div>
                </div>

                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48"
                        src="https://cdn.pixabay.com/photo/2015/10/02/15/59/olive-oil-968657_960_720.jpg"
                        alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="px-4 py-0.5 text-sm bg-pink-500 rounded-full text-pink-50">Tea</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">Fresh Tea</h4>
                        <p class="leading-normal text-gray-700">Lorem ipsum dolor, sit amet cons ectetur adipis icing
                            elit.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <button class="px-4 py-2 bg-green-600 text-green-50">Order Now</button>
                        <span class="text-xl text-green-600">$4.00</span>
                    </div>
                </div>
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48"
                        src="https://cdn.pixabay.com/photo/2015/04/08/13/13/food-712665_960_720.jpg" alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">Seafood</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">salmon fish 3
                            seafood</h4>
                        <p class="leading-normal text-gray-700">Lorem ipsum dolor, sit amet cons ectetur adipis icing
                            elit.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <button class="px-4 py-2 bg-green-600 text-green-50">Order Now</button>
                        <span class="text-xl text-green-600">$50.12</span>
                    </div>
                </div>

                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48"
                        src="https://cdn.pixabay.com/photo/2015/10/02/15/59/olive-oil-968657_960_720.jpg"
                        alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="px-4 py-0.5 text-sm bg-pink-500 rounded-full text-pink-50">Tea</span>
                        </div>
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">Fresh Tea</h4>
                        <p class="leading-normal text-gray-700">Lorem ipsum dolor, sit amet cons ectetur adipis icing
                            elit.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <button class="px-4 py-2 bg-green-600 text-green-50">Order Now</button>
                        <span class="text-xl text-green-600">$4.00</span>
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
                <img class="" src="{{ asset('src/images/cover/separator.svg') }}" alt=""
                    width="100">
            </div>
            <h1 class="text-center text-4xl text-white mb-15">
                Paket Nasi Box
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @foreach ($menus->take(6) as $menu)
                    <div class="flex items-start space-x-4 pb-4 border-b border-gray-700">
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
                                @foreach ($menu->detailMenus as $detail)
                                    {{ $detail->nama }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <p class="text-sm text-gray-400">
                    During winter daily from
                    <span class="font-bold">7:00 pm</span> to
                    <span class="font-bold">9:00 pm</span>
                </p>
                <button
                    class="mt-4 px-4 py-2 text-sm text-[#E0C48B] border border-[#E0C48B] hover:bg-[#b69b41] hover:text-gray-900 transition-colors">
                    <a href="#">PESAN SEKARANG</a>
                </button>
            </div>
        </div>
    </section>

    {{-- <section class="pt-4 pb-12 bg-gray-800">
        <div class="my-16 text-center">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                Testimonial </h2>
            <p class="text-xl text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. soluta sapient</p>
        </div>
        <div class="grid gap-2 lg:grid-cols-3">
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full"
                        src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Food</h2>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores
                        deserunt
                        ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis
                        pariatur
                        minus consequuntur!</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">John Doe</a>
                </div>
            </div>
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full"
                        src="https://cdn.pixabay.com/photo/2018/01/04/21/15/young-3061652__340.jpg">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Food</h2>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores
                        deserunt
                        ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis
                        pariatur
                        minus consequuntur!</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">John Doe</a>
                </div>
            </div>
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full"
                        src="https://cdn.pixabay.com/photo/2018/01/18/17/48/purchase-3090818__340.jpg">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Food</h2>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores
                        deserunt
                        ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis
                        pariatur
                        minus consequuntur!</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">John Doe</a>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="pt-12 pb-12 bg-gradient-to-r min-h-screen from-[#1f1f22] to-[#151518] font-['Inter',sans-serif]">
        <div class="container mx-auto p-6 sm:p-12 md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Reservasi Online (Bagian Kiri) -->
                <div class="md:col-span-2 bg-[#0D0D0B] shadow-lg p-8">
                    <h1 class="text-6xl mb-4 text-white text-center">Reservasi Online</h1>
                    <p class="text-sm mb-6 text-white text-center">
                        Booking request <span class="text-[#E0C48B]">+88-123-123456</span> or fill out the order form
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
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:border-[#FFE077] transition-colors @error('nama_depan') @enderror"
                                required>
                            <input type="text" name="nama_belakang" placeholder="Nama Belakang"
                                value="{{ old('nama_belakang') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:border-[#FFE077] transition-colors @error('nama_belakang') @enderror"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:border-[#FFE077] transition-colors @error('email') @enderror"
                                required>
                            <input type="text" name="no_telepon" placeholder="Nomor Telepon"
                                value="{{ old('no_telepon') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:border-[#FFE077] transition-colors @error('no_telepon') @enderror"
                                required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <select name="jumlahPengunjung"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:border-[#FFE077] transition-colors @error('jumlahPengunjung') @enderror"
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
                            </select>
                            <input type="datetime-local" name="tanggal" placeholder="Tanggal dan Waktu"
                                value="{{ old('tanggal', date('Y-m-d\TH:i')) }}" min="{{ date('Y-m-d\TH:i') }}"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:border-[#FFE077] transition-colors @error('tanggal') @enderror"
                                required>

                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                            <select name="idMeja"
                                class="p-3 bg-[#1A1A1C] border border-gray-700 text-white focus:outline-none focus:border-[#FFE077] transition-colors @error('idMeja') @enderror"
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
                            class="w-full p-3 bg-[#FFE077] text-black font-bold hover:bg-[#b69b41] transition-colors">
                            BUAT RESERVASI
                        </button>
                    </form>
                </div>

                <!-- Contact Us (Bagian Kanan) -->
                <div class="bg-no-repeat bg-cover bg-center p-8 h-full"
                    style="background-image: url('{{ asset('src/images/cover/form-pattern.png') }}')">
                    <h1 class="text-4xl font-bold mb-4 text-white">Contact Us</h1>
                    <p class="text-lg mb-6 text-white">
                        Booking Request <span class="text-[#E0C48B]">+88-123-123456</span>
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-lg mb-4 text-white">
                        <strong>Location</strong><br>
                        Restaurant St, Delicious City,<br>
                        London 9578, UK
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-lg mb-4 text-white">
                        <strong>Lunch Time</strong><br>
                        Monday to Sunday<br>
                        11.00 am - 2.30pm
                    </p>
                    <div class="border-t border-gray-700 my-4"></div>
                    <p class="text-lg mb-4 text-white">
                        <strong>Dinner Time</strong><br>
                        Monday to Sunday<br>
                        05.00 pm - 10.00pm
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
