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
            'href' => '#',
            'active' => false,
        ],
        [
            'label' => 'Users',
            'icon' => 'group',
            'href' => Route::has('users.index') ? route('users.index') : '#',
            'active' => request()->routeIs('users.*'),
        ],
    ];
@endphp

<aside class="fixed left-0 top-0 z-50 h-full w-72 border-r border-[#eadfd4] bg-white/70 backdrop-blur-xl dark:border-white/10 dark:bg-[#0f1116]/80">
    <div class="flex h-full flex-col px-6 py-8">
        <div class="mb-8 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-primary-deep text-white shadow-lg shadow-primary/30">
                <span class="material-symbols-outlined text-[20px]">weekend</span>
            </div>
            <div>
                <p class="text-xl font-extrabold tracking-tight">HOMELIVING</p>
                <p class="text-[10px] uppercase tracking-[0.18em] text-[#6e5a50] dark:text-[#9a6c4c]">Studio Admin</p>
            </div>
        </div>

        <nav class="space-y-2">
            @foreach ($links as $link)
                <a
                    href="{{ $link['href'] }}"
                    class="{{ $link['active']
                        ? 'group flex items-center gap-3 rounded-xl border-l-[3px] border-primary bg-primary/5 dark:bg-primary/10 px-4 py-3 text-sm font-semibold text-primary'
                        : 'group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-[#51423a] dark:text-white/70 transition-colors hover:bg-black/5 dark:hover:bg-white/5 hover:text-primary' }}"
                >
                    <span class="material-symbols-outlined text-[18px]">{{ $link['icon'] }}</span>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <a
            href="{{ Route::has('products.create') ? route('products.create') : '#' }}"
            class="mt-8 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-primary to-primary-deep px-4 py-3 text-sm font-bold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95"
        >
            <span class="material-symbols-outlined text-[18px]">add</span>
            New Collection
        </a>

        <div class="mt-auto border-t border-[#eadfd4] pt-6 dark:border-white/10">
            <a
                href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}"
                class="group mb-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-[#51423a] transition-colors hover:bg-black/5 hover:text-primary dark:text-white/70 dark:hover:bg-white/5"
            >
                <span class="material-symbols-outlined text-[18px]">settings</span>
                Settings
            </a>
            <a
                href="{{ Route::has('email.form') ? route('email.form') : '#' }}"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-[#51423a] transition-colors hover:bg-black/5 hover:text-primary dark:text-white/70 dark:hover:bg-white/5"
            >
                <span class="material-symbols-outlined text-[18px]">help</span>
                Support
            </a>
        </div>
    </div>
</aside>
