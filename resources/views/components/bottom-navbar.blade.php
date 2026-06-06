<nav class="md:hidden fixed bottom-4 left-0 right-0 mx-auto z-50 flex items-center justify-around h-16 px-6 glass-morphism w-[min(92vw,44rem)] rounded-full border border-black/10 dark:border-white/10 shadow-[0_20px_40px_rgba(27,28,27,0.08)] dark:shadow-[0_20px_40px_rgba(0,0,0,0.35)]">
    <a class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('homepage.home') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}"
        href="{{ route('homepage.home') }}">
        <span class="material-symbols-outlined" @if(Route::is('homepage.home')) style="font-variation-settings: 'FILL' 1;" @endif>home</span>
        <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Home</span>
    </a>

    <a class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('homepage.product') || Route::is('product.detail') || Route::is('products.detail') || Route::is('productss') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}"
        href="{{ route('homepage.product') }}">
        <span class="material-symbols-outlined" @if(Route::is('homepage.product') || Route::is('product.detail') || Route::is('products.detail') || Route::is('productss')) style="font-variation-settings: 'FILL' 1;" @endif>chair</span>
        <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Products</span>
    </a>

    <a class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('email.form') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}"
        href="{{ route('email.form') }}">
        <span class="material-symbols-outlined" @if(Route::is('email.form')) style="font-variation-settings: 'FILL' 1;" @endif>mail</span>
        <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Contact</span>
    </a>

    @auth
        <div class="relative" x-data="{ profileOpen: false }">
            <button @click="profileOpen = !profileOpen" @keydown.escape.window="profileOpen = false"
                class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('profile.edit') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}">
                <span class="material-symbols-outlined" @if(Route::is('profile.edit')) style="font-variation-settings: 'FILL' 1;" @endif>person</span>
                <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Profile</span>
            </button>
            <div x-show="profileOpen" x-cloak @click.outside="profileOpen = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                class="absolute bottom-full right-0 mb-2 w-44 origin-bottom-right">
                <div class="rounded-2xl border border-black/10 dark:border-white/10 bg-white/95 dark:bg-[#1b1c1b] p-1.5 shadow-xl backdrop-blur-xl">
                    <a href="{{ route('profile.edit') }}" @click="profileOpen = false"
                        class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-[#2a2019] dark:text-white/80 transition-colors hover:bg-black/5 dark:hover:bg-white/5">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                        My Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="border-t border-black/10 dark:border-white/10 pt-1 mt-1">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <a class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('login') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}"
            href="{{ route('login') }}">
            <span class="material-symbols-outlined" @if(Route::is('login')) style="font-variation-settings: 'FILL' 1;" @endif>person</span>
            <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Profile</span>
        </a>
    @endauth
</nav>
