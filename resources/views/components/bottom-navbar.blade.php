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
        <a class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('profile.edit') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}"
            href="{{ route('profile.edit') }}">
            <span class="material-symbols-outlined" @if(Route::is('profile.edit')) style="font-variation-settings: 'FILL' 1;" @endif>person</span>
            <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Profile</span>
        </a>
    @else
        <a class="flex flex-col items-center justify-center transition-all duration-300 {{ Route::is('login') ? 'text-primary scale-105' : 'text-[#1b1c1b] dark:text-white opacity-45 hover:opacity-100' }}"
            href="{{ route('login') }}">
            <span class="material-symbols-outlined" @if(Route::is('login')) style="font-variation-settings: 'FILL' 1;" @endif>person</span>
            <span class="text-[11px] font-medium uppercase tracking-[0.05em] mt-1">Profile</span>
        </a>
    @endauth
</nav>
