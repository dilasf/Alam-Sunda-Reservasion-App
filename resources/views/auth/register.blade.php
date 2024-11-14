<!-- resources/views/auth/register.blade.php -->
<x-guest-layout>
    <div class="min-h-screen bg-[#1A1A1C] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-[#141416] shadow-xl">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-800">
                    <h2 class="text-2xl font-bold text-center text-[#E0C48B]">
                        Buat Akun
                    </h2>
                </div>

                <!-- Form -->
                <div class="px-6 py-4">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#E0C48B]">
                                {{ __('Nama') }}
                            </label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                autofocus autocomplete="name"
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                            @error('name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-[#E0C48B]">
                                {{ __('Email') }}
                            </label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                autocomplete="username"
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                            @error('email')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="nomorTelepon" class="block text-sm font-medium text-[#E0C48B]">
                                {{ __('Nomor Telepon') }}
                            </label>
                            <input id="nomorTelepon" name="nomorTelepon" type="text"
                                value="{{ old('nomorTelepon') }}" required maxlength="14"
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                            @error('nomorTelepon')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-[#E0C48B]">
                                {{ __('Password') }}
                            </label>
                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                            @error('password')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-[#E0C48B]">
                                {{ __('Konfirmasi Password') }}
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                autocomplete="new-password"
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                        </div>

                        <!-- Login Link and Register Button -->
                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('login') }}"
                                class="text-sm text-[#E0C48B] hover:text-[#FFE077] underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E0C48B]">
                                {{ __('Sudah Terdaftar?') }}
                            </a>

                            <button type="submit"
                                class="px-4 py-2 shadow-sm text-sm font-medium text-black bg-[#E0C48B] hover:bg-[#FFE077] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E0C48B] transition-colors duration-200">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
