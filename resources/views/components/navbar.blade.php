<div class="flex flex-col sticky top-0 z-50 bg-[#e2f8f6]" id="navbar">
    <header class="flex justify-between items-center p-6 px-4 lg:px-24">
        <div class="text-left">
            <a href="{{ route('homepage.home') }}">
                <h1 class="text-xl font-bold">PT. HARUM SARI</h1>
                <p class="text-sm">WOODCRAFT HOMELIVING</p>
            </a>
        </div>
        <nav class="hidden md:flex space-x-8 text-sm font-normal items-center">
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.home') }}">HOME</a>
            <a class="hover:text-[#D6B390] {{ Route::currentRouteNamed('email.form') ? 'bg-teal-400 px-5 py-1 rounded-full' : '' }}"
                href="{{ route('email.form') }}">CONTACT US</a>
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.product') }}">PRODUCT</a>
        </nav>

        <!-- Jika pengguna sudah login -->
        @auth
            <div class="flex">
                <div class="relative">
                    <a href="{{ route('cart.index') }}" class="relative">
                        <i class="fas fa-shopping-cart text-2xl text-gray-700 hover:text-gray-900"></i>
                        @if(session('cart_count', 0) > 0)
                            <span
                                class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ session('cart_count') }}
                            </span>
                        @endif
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        @endauth

        <!-- Jika pengguna belum login -->
        @guest
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600">
                    Login
                </a>
            </div>
        @endguest

        <div class="md:hidden">
            <button id="menu-btn" class="text-gray-700 focus:outline-none">
                <i class="fas fa-bars fa-2x"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#e2f8f6] shadow-md sticky top-16 z-40">
        <nav class="flex flex-col space-y-4 p-4 text-sm font-medium">
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.home') }}">HOME</a>
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.home') }}#section2">CATEGORY</a>
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.home') }}#section3">FEATURED</a>
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.home') }}#section4">TESTIMONIALS</a>
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.home') }}#section5">WHY CHOOSE US</a>
            <a class="hover:text-[#D6B390]" href="{{ route('email.form') }}">CONTACT US</a>
            <a class="hover:text-[#D6B390]" href="{{ route('homepage.product') }}">PRODUCT</a>
        </nav>
    </div>
</div>