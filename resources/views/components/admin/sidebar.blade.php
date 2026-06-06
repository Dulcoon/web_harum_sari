@props(['open' => 'sidebarOpen', 'collapsed' => 'sidebarCollapsed'])

@php
    $links = [
        [
            'label' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'label' => 'Products',
            'icon' => 'chair',
            'href' => Route::has('products.index') ? route('products.index') : '#',
            'active' => request()->routeIs('products.*'),
        ],
        [
            'label' => 'Categories',
            'icon' => 'category',
            'href' => Route::has('category.index') ? route('category.index') : '#',
            'active' => request()->routeIs('category.*'),
        ],
        [
            'label' => 'Orders',
            'icon' => 'shopping_cart',
            'href' => Route::has('orders.index') ? route('orders.index') : '#',
            'active' => request()->routeIs('orders.*'),
        ],
        [
            'label' => 'Users',
            'icon' => 'group',
            'href' => Route::has('users.index') ? route('users.index') : '#',
            'active' => request()->routeIs('users.*'),
        ],
        [
            'label' => 'Settings',
            'icon' => 'settings',
            'href' => Route::has('settings.index') ? route('settings.index') : '#',
            'active' => request()->routeIs('settings.*'),
        ],
    ];
@endphp

{{-- Overlay for mobile --}}
<div
    x-show="{{ $open }}"
    x-cloak
    @click="{{ $open }} = false"
    class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden"
    x-transition:enter="transition-opacity duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
></div>

<aside
    x-cloak
    class="fixed left-0 top-0 z-50 flex h-full w-72 flex-col border-r border-[#eadfd4] bg-white/70 px-6 py-8 backdrop-blur-xl transition-all duration-300 ease-in-out dark:border-white/10 dark:bg-[#0f1116]/80 lg:translate-x-0"
    :class="{{ $collapsed }} ? 'lg:w-20 lg:px-3' : ''"
>
    {{-- Logo / Brand --}}
    <div
        x-data="{ hoverLogo: false }"
        @mouseenter="hoverLogo = true"
        @mouseleave="hoverLogo = false"
        class="mb-8"
    >
        <div class="flex items-center justify-between" :class="{{ $collapsed }} ? 'lg:flex-col lg:justify-center lg:gap-2' : ''">
            <div class="flex items-center gap-3" :class="{{ $collapsed }} ? 'lg:flex-col lg:gap-1' : ''">
                {{-- Logo icon — morphs on hover when collapsed --}}
                <div
                    @click="{{ $collapsed }} ? ({{ $collapsed }} = false, localStorage.setItem('sidebarCollapsed', false)) : null"
                    :class="hoverLogo && {{ $collapsed }}
                        ? 'cursor-pointer rounded-xl border border-[#eadfd4] bg-white/80 shadow-sm dark:border-white/10 dark:bg-white/10'
                        : 'rounded-xl bg-gradient-to-br from-primary to-primary-deep text-white shadow-lg shadow-primary/30'"
                    class="flex h-10 w-10 shrink-0 items-center justify-center transition-all duration-300"
                >
                    {{-- Normal logo --}}
                    <svg x-show="!hoverLogo || !{{ $collapsed }}" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    {{-- Expand icon on hover when collapsed --}}
                    <svg x-show="hoverLogo && {{ $collapsed }}" class="h-5 w-5 text-[#51423a] dark:text-white/80" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1.5" y="3" width="17" height="14" rx="1.5"/>
                        <line x1="8" y1="3" x2="8" y2="17"/>
                        <polyline points="10.5 8.5 12.5 10 10.5 11.5"/>
                    </svg>
                </div>

                {{-- Brand text --}}
                <div :class="{{ $collapsed }} ? 'lg:hidden' : ''">
                    <p class="text-xl font-extrabold tracking-tight">HOMELIVING</p>
                    <p class="text-[10px] uppercase tracking-[0.18em] text-[#6e5a50] dark:text-[#9a6c4c]">Studio Admin</p>
                </div>
            </div>

            {{-- Toggle button when expanded (desktop only) --}}
            <button
                type="button"
                @click.stop="{{ $collapsed }} = !{{ $collapsed }}; localStorage.setItem('sidebarCollapsed', {{ $collapsed }})"
                x-show="!{{ $collapsed }}"
                class="hidden h-7 w-7 items-center justify-center rounded-lg text-[#8b7266] transition-colors hover:bg-black/5 hover:text-primary dark:text-[#9a6c4c] dark:hover:bg-white/5 lg:flex"
                aria-label="Collapse sidebar"
            >
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1.5" y="3" width="17" height="14" rx="1.5"/>
                    <line x1="8" y1="3" x2="8" y2="17"/>
                    <polyline points="5.5 8.5 3.5 10 5.5 11.5"/>
                </svg>
            </button>

            {{-- Close button for mobile --}}
            <button
                type="button"
                @click="{{ $open }} = false"
                class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-[#51423a] hover:bg-black/5 dark:text-white/70 dark:hover:bg-white/5 lg:hidden"
                aria-label="Close sidebar"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="space-y-1">
        @foreach ($links as $link)
            <a
                href="{{ $link['href'] }}"
                @click="{{ $open }} = false"
                :class="{{ $collapsed }} ? 'lg:gap-0 lg:justify-center lg:px-0' : ''"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-[#51423a] transition-colors hover:bg-black/5 hover:text-primary dark:text-white/70 dark:hover:bg-white/5 {{ $link['active'] ? 'border-l-[3px] border-primary bg-primary/5 font-semibold text-primary dark:bg-primary/10' : '' }}"
            >
                <span class="material-symbols-outlined text-[18px]">{{ $link['icon'] }}</span>
                <span :class="{{ $collapsed }} ? 'lg:hidden' : ''">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- New Collection button --}}
    <a
        href="{{ Route::has('products.create') ? route('products.create') : '#' }}"
        @click="{{ $open }} = false"
        :class="{{ $collapsed }} ? 'lg:justify-center lg:px-0 lg:mx-0' : ''"
        class="mt-8 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-primary to-primary-deep px-4 py-3 text-sm font-bold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95"
    >
        <span class="material-symbols-outlined text-[18px]">add</span>
        <span :class="{{ $collapsed }} ? 'lg:hidden' : ''">New Collection</span>
    </a>

    {{-- Bottom links --}}
    <div class="mt-auto border-t border-[#eadfd4] pt-6 dark:border-white/10">
        <a
            href="{{ Route::has('email.form') ? route('email.form') : '#' }}"
            @click="{{ $open }} = false"
            :class="{{ $collapsed }} ? 'lg:gap-0 lg:justify-center lg:px-0' : ''"
            class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-[#51423a] transition-colors hover:bg-black/5 hover:text-primary dark:text-white/70 dark:hover:bg-white/5"
        >
            <span class="material-symbols-outlined text-[18px]">help</span>
            <span :class="{{ $collapsed }} ? 'lg:hidden' : ''">Support</span>
        </a>
    </div>
</aside>
