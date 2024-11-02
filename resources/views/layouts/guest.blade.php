<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add required JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="shadow-md bg-[#141416]" x-data="{ isOpen: false }">
        <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <a class="text-xl font-bold bg-clip-text bg-gradient-to-r text-[#E0C48B] md:text-2xl hover:text-[#FFE077]"
                    href="#">
                    AlsundReserv
                </a>
                <!-- Mobile menu button -->
                <div @click="isOpen = !isOpen" class="flex md:hidden">
                    <button type="button"
                        class="text-[#E0C48B] hover:text-[#FFE077] focus:outline-none focus:text-[#FFE077]"
                        aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="isOpen ? 'flex' : 'hidden'"
                class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
                <a class="bg-clip-text bg-gradient-to-r text-[#E0C48B] hover:text-[#FFE077]" href="#">Home</a>
                <a class="bg-clip-text bg-gradient-to-r text-[#E0C48B] hover:text-[#FFE077]" href="#">Tentang
                    Kami</a>
                <a class="bg-clip-text bg-gradient-to-r text-[#E0C48B] hover:text-[#FFE077]"
                    href="{{ route('frontend.pemesanan.index') }}">Pemesanan</a>
                <a class="bg-clip-text bg-gradient-to-r text-[#E0C48B] hover:text-[#FFE077]"
                    href="#">Reservasi</a>
            </div>
            @guest
                <div class="flex items-center space-x-4">
                    <a href="/login"
                        class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400">
                        Log in
                    </a>
                    <a href="/register"
                        class="px-4 py-2 text-sm font-medium text-black transition-colors duration-200 bg-[#E0C48B] rounded-md hover:from-green-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400">
                        Sign up
                    </a>
                </div>
            @endguest
            @auth
                <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                    <a class="flex items-center gap-4" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">
                        <span class="hidden text-right lg:block">
                            <span class="block text-sm font-medium text-[#E0C48B]">{{ Auth::user()->name }}</span>
                            <span class="block text-xs font-medium text-[#E0C48B]">{{ Auth::user()->role_text }}</span>
                        </span>

                        <svg :class="dropdownOpen && 'rotate-180'" class="hidden fill-current sm:block" width="12"
                            height="8" viewBox="0 0 12 8" fill="#E0C48B" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                                fill="#E0C48B" />
                        </svg>
                    </a>

                    <!-- Dropdown Start -->
                    <div x-show="dropdownOpen"
                        class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm  bg-[#141416] shadow-default dark:border-strokedark dark:bg-boxdark z-50">
                        <ul class="flex flex-col gap-5 px-6 py-7.5 dark:border-strokedark">
                            <li>
                                <a href="profile.html"
                                    class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out text-[#E0C48B] hover:text-[#FFE077] lg:text-base">
                                    <svg class="fill-[#E0C48B]" width="22" height="22" viewBox="0 0 22 22"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"
                                            fill="" />
                                        <path
                                            d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.10935 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"
                                            fill="" />
                                    </svg>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out text-[#E0C48B] hover:text-[#FFE077] lg:text-base">
                                        <svg class="fill-[#E0C48B]" width="22" height="22" viewBox="0 0 22 22"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.5375 0.618744H11.6531C10.7594 0.618744 10.0031 1.37499 10.0031 2.26874V4.64062C10.0031 5.05312 10.3469 5.39687 10.7594 5.39687C11.1719 5.39687 11.55 5.05312 11.55 4.64062V2.23437C11.55 2.16562 11.5844 2.13124 11.6531 2.13124H15.5375C16.3625 2.13124 17.0156 2.78437 17.0156 3.60937V18.3562C17.0156 19.1812 16.3625 19.8344 15.5375 19.8344H11.6531C11.5844 19.8344 11.55 19.8 11.55 19.7312V17.3594C11.55 16.9469 11.2062 16.6031 10.7594 16.6031C10.3125 16.6031 10.0031 16.9469 10.0031 17.3594V19.7312C10.0031 20.625 10.7594 21.3812 11.6531 21.3812H15.5375C17.2219 21.3812 18.5625 20.0062 18.5625 18.3562V3.64374C18.5625 1.95937 17.1875 0.618744 15.5375 0.618744Z"
                                                fill="" />
                                            <path
                                                d="M6.05001 11.7563H12.2031C12.6156 11.7563 12.9594 11.4125 12.9594 11C12.9594 10.5875 12.6156 10.2438 12.2031 10.2438H6.08439L8.21564 8.07813C8.52501 7.76875 8.52501 7.2875 8.21564 6.97812C7.90626 6.66875 7.42501 6.66875 7.11564 6.97812L3.67814 10.4844C3.36876 10.7938 3.36876 11.275 3.67814 11.5844L7.11564 15.0906C7.25314 15.2281 7.45939 15.3312 7.66564 15.3312C7.87189 15.3312 8.04376 15.2625 8.21564 15.125C8.52501 14.8156 8.52501 14.3344 8.21564 14.025L6.05001 11.7563Z"
                                                fill="" />
                                        </svg>
                                        Log Out
                                    </a>
                                </form>
                            </li>
                        </ul>

                    </div>
                    <!-- Dropdown End -->
                </div>
            @endauth
        </nav>
    </div>
    <div class="font-sans text-gray-900 antialiased min-h-screen">
        {{ $slot }}
    </div>
    <footer class="shadow-md bg-[#141416]">
        <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto lg:justify-between">
            <div class="flex flex-wrap justify-center">
                <ul class="flex items-center space-x-4 text-[#E0C48B]">
                    <li>Home</li>
                    <li>About</li>
                    <li>Contact</li>
                    <li>Terms</li>
                </ul>
            </div>
            <div class="flex justify-center mt-4 lg:mt-0">
                <a>
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-6 h-6 text-blue-600" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-6 h-6 text-blue-300" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </div>
        </div>
    </footer>
    <script>
        class OrderSystem {
            constructor() {
                this.state = {
                    orderItems: [],
                    isSubmitting: false
                };

                this.elements = {
                    orderItems: document.getElementById('orderItems'),
                    emptyMessage: document.getElementById('emptyOrderMessage'),
                    totalAmount: document.getElementById('totalAmount'),
                    orderForm: document.getElementById('orderForm'),
                    toast: document.getElementById('toast')
                };

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.updateUI();
            }

            setupEventListeners() {
                document.querySelectorAll('.btn-add-menu').forEach(button => {
                    button.addEventListener('click', (e) => this.handleAddMenuItem(e));
                });

                this.elements.orderForm.addEventListener('submit', (e) => this.handleSubmitOrder(e));
            }

            async handleSubmitOrder(e) {
                e.preventDefault();
                if (this.state.isSubmitting) return;

                this.state.isSubmitting = true;
                const submitButton = e.target.querySelector('button[type="submit"]');
                this.setLoading(submitButton, true);

                try {
                    const formData = {
                        items: this.state.orderItems.map(item => ({
                            menu_id: item.id,
                            jumlah: item.quantity
                        })),
                        tipePesanan: document.querySelector('select[name="orderType"]').value
                    };

                    const response = await this.submitOrder(formData);

                    if (response.status === 'success') {
                        this.showToast('Order created successfully!');
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 1000);
                    } else {
                        throw new Error(response.message || 'An error occurred');
                    }

                } catch (error) {
                    console.error('Error:', error);
                    this.showToast(error.message || 'An error occurred. Please try again.', 'error');
                } finally {
                    this.state.isSubmitting = false;
                    this.setLoading(submitButton, false);
                }
            }

            async submitOrder(formData) {
                const response = await fetch("{{ route('frontend.pemesanan.process') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Network response was not ok');
                }

                return response.json();
            }

            handleAddMenuItem(e) {
                const button = e.currentTarget;
                const menuData = JSON.parse(button.dataset.menu);

                this.setLoading(button, true);
                this.addMenuItem(menuData);
                this.showToast(`${menuData.nama} added to order`);

                setTimeout(() => this.setLoading(button, false), 500);
            }

            addMenuItem({
                id,
                nama,
                harga
            }) {
                const existingItem = this.state.orderItems.find(item => item.id === id);

                if (existingItem) {
                    this.updateItemQuantity(
                        this.state.orderItems.indexOf(existingItem),
                        existingItem.quantity + 1
                    );
                    return;
                }

                this.state.orderItems.push({
                    id,
                    nama,
                    harga,
                    quantity: 1
                });

                this.updateUI();
            }

            updateItemQuantity(index, quantity) {
                quantity = Math.max(1, parseInt(quantity) || 1);

                if (index >= 0 && index < this.state.orderItems.length) {
                    this.state.orderItems[index].quantity = quantity;
                    this.updateUI();
                }
            }

            removeItem(index) {
                if (index >= 0 && index < this.state.orderItems.length) {
                    this.state.orderItems.splice(index, 1);
                    this.updateUI();
                }
            }

            updateUI() {
                this.elements.emptyMessage.classList.toggle('hidden', this.state.orderItems.length > 0);
                this.updateOrderItems();
                this.updateTotalAmount();
            }

            updateOrderItems() {
                this.elements.orderItems.innerHTML = this.state.orderItems
                    .map((item, index) => this.createOrderItemHTML(item, index))
                    .join('');
            }

            updateTotalAmount() {
                const total = this.state.orderItems.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
                this.elements.totalAmount.textContent = this.formatCurrency(total);
            }

            createOrderItemHTML(item, index) {
                return `
                    <div class="order-item bg-[#1A1A1C] rounded-lg p-4" data-index="${index}">
                        <h4 class="text-white font-semibold mb-2">${item.nama}</h4>
                        <div class="flex items-center justify-between gap-4">
                            <div class="w-1/2 flex items-center">
                                <button type="button"
                                    class="px-3 py-2 bg-[#E0C48B] text-black rounded-l-md hover:bg-[#b69b41]"
                                    onclick="orderSystem.updateItemQuantity(${index}, ${item.quantity - 1})">
                                    -
                                </button>
                                <input type="number"
                                    class="w-16 p-2 bg-[#242427] border-t border-b border-gray-700 text-white text-center"
                                    value="${item.quantity}"
                                    min="1"
                                    onchange="orderSystem.updateItemQuantity(${index}, this.value)">
                                <button type="button"
                                    class="px-3 py-2 bg-[#E0C48B] text-black rounded-r-md hover:bg-[#b69b41]"
                                    onclick="orderSystem.updateItemQuantity(${index}, ${item.quantity + 1})">
                                    +
                                </button>
                            </div>
                            <button type="button"
                                class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                onclick="orderSystem.removeItem(${index})">
                                Remove
                            </button>
                        </div>
                        <div class="mt-2 text-[#E0C48B]">
                            Subtotal: Rp ${this.formatCurrency(item.harga * item.quantity)}
                        </div>
                    </div>
                `;
            }

            setLoading(element, isLoading) {
                const textElement = element.querySelector('.btn-text');
                const loadingElement = element.querySelector('.btn-loading');

                textElement.classList.toggle('hidden', isLoading);
                loadingElement.classList.toggle('hidden', !isLoading);
                element.disabled = isLoading;
            }

            showToast(message, type = 'success') {
                const toast = this.elements.toast;
                const messageElement = document.getElementById('toastMessage');
                const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';

                toast.firstElementChild.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg`;
                messageElement.textContent = message;
                toast.classList.remove('translate-y-full');

                setTimeout(() => {
                    toast.classList.add('translate-y-full');
                }, 3000);
            }

            formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID').format(amount);
            }
        }

        // Initialize the order system
        const orderSystem = new OrderSystem();
    </script>
</body>

</html>
