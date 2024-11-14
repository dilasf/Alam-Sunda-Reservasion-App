<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <div class="min-h-screen bg-[#1A1A1C] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-[#141416] shadow-xl">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-800">
                    <h2 class="text-2xl font-bold text-center text-[#E0C48B]">
                        Masuk
                    </h2>
                </div>

                <!-- Form -->
                <div class="px-6 py-4">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-[#E0C48B]">
                                Email
                            </label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                autofocus
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-[#E0C48B]">
                                Password
                            </label>
                            <input id="password" name="password" type="password" required
                                class="mt-1 block w-full px-3 py-2 bg-[#1A1A1C] text-[#E0C48B] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#E0C48B] focus:border-[#E0C48B]">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 bg-[#1A1A1C] border-gray-700 rounded text-[#E0C48B] focus:ring-[#E0C48B]">
                                <label for="remember_me" class="ml-2 block text-sm text-[#E0C48B]">
                                    Ingat Saya
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-[#E0C48B] hover:text-[#FFE077]">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 shadow-sm text-sm font-medium text-black bg-[#E0C48B] hover:bg-[#FFE077] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E0C48B] transition-colors duration-200">
                                Masuk
                            </button>
                        </div>

                        <!-- Registration Link -->
                        <div class="text-center mt-4">
                            <span class="text-[#E0C48B]">Tidak Punya Akun?</span>
                            <a href="{{ route('register') }}" class="ml-1 text-[#E0C48B] hover:text-[#FFE077]">
                                Daftar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
