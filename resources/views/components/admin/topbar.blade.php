@props([
    'placeholder' => 'Search analytics...',
    'searchAction' => null,
    'searchName' => 'q',
    'searchValue' => '',
    'adminName' => null,
    'adminRole' => 'Chief Curator',
    'showThemeToggle' => true,
])

@php
    $resolvedAdminName = $adminName ?? (Auth::user()->name ?? 'Admin User');
@endphp

<header class="sticky top-0 z-40 border-b border-[#eadfd4] bg-white/70 backdrop-blur-xl dark:border-white/10 dark:bg-[#0b0d12]/85">
    <div class="flex items-center justify-between gap-2 px-3 py-3 sm:gap-4 sm:px-4 lg:px-8">
        <div class="flex items-center gap-2 sm:gap-4">
            <button
                type="button"
                @click="$dispatch('toggle-sidebar')"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-[#51423a] transition-colors hover:bg-black/5 dark:text-white/70 dark:hover:bg-white/5 lg:hidden"
                aria-label="Toggle sidebar"
            >
                <span class="material-symbols-outlined text-[22px]">menu</span>
            </button>

            @if ($searchAction)
                <form method="GET" action="{{ $searchAction }}" class="hidden w-full max-w-md sm:block md:max-w-lg">
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[18px] text-[#8b7266] dark:text-[#9a6c4c]">search</span>
                        <input
                            name="{{ $searchName }}"
                            value="{{ $searchValue }}"
                            type="text"
                            placeholder="{{ $placeholder }}"
                            class="h-10 w-full rounded-xl border border-[#eadfd4] bg-white/70 pl-10 pr-3 text-sm text-[#1b1c1b] placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]"
                        />
                    </div>
                </form>
            @else
                <div class="hidden sm:block relative w-full max-w-md md:max-w-lg">
                    <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[18px] text-[#8b7266] dark:text-[#9a6c4c]">search</span>
                    <input
                        type="text"
                        placeholder="{{ $placeholder }}"
                        class="h-10 w-full rounded-xl border border-[#eadfd4] bg-white/70 pl-10 pr-3 text-sm text-[#1b1c1b] placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]"
                    />
                </div>
            @endif
        </div>

        <div class="flex items-center gap-1 sm:gap-2">
            @if ($showThemeToggle)
                <button type="button" id="theme-toggle-btn" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-[#51423a] transition-colors hover:bg-black/5 dark:text-white/70 dark:hover:bg-white/5 sm:h-10 sm:w-10">
                    <span id="theme-toggle-icon" class="material-symbols-outlined text-[19px]">light_mode</span>
                </button>
            @endif

            <button type="button" class="relative hidden sm:inline-flex h-9 w-9 items-center justify-center rounded-lg text-[#51423a] transition-colors hover:bg-black/5 dark:text-white/70 dark:hover:bg-white/5 sm:h-10 sm:w-10">
                <span class="material-symbols-outlined text-[19px]">notifications</span>
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-primary"></span>
            </button>

            <button type="button" class="hidden sm:inline-flex h-9 w-9 items-center justify-center rounded-lg text-[#51423a] transition-colors hover:bg-black/5 dark:text-white/70 dark:hover:bg-white/5 sm:h-10 sm:w-10">
                <span class="material-symbols-outlined text-[19px]">mail</span>
            </button>

            <div
                class="relative ml-1 border-l border-[#eadfd4] pl-2 dark:border-white/10 sm:ml-2 sm:pl-3"
                x-data="{ profileOpen: false }"
            >
                <button
                    type="button"
                    @click="profileOpen = !profileOpen"
                    @keydown.escape.window="profileOpen = false"
                    class="flex items-center gap-1 sm:gap-2 focus:outline-none"
                >
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-bold leading-tight">{{ $resolvedAdminName }}</p>
                        <p class="text-[10px] uppercase tracking-[0.16em] text-[#6e5a50] dark:text-[#9a6c4c]">{{ $adminRole }}</p>
                    </div>
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($resolvedAdminName) }}&background=0B5C80&color=fff"
                        alt="{{ $resolvedAdminName }}"
                        class="h-8 w-8 rounded-full border border-white/60 object-cover shadow sm:h-10 sm:w-10"
                    />
                    <svg class="hidden h-4 w-4 text-[#8b7266] transition-transform duration-200 sm:block dark:text-[#9a6c4c]" :class="profileOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 8 10 12 14 8"/>
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div
                    x-show="profileOpen"
                    x-cloak
                    @click.outside="profileOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                    class="absolute right-0 z-50 mt-2 w-56 origin-top-right"
                >
                    <div class="rounded-2xl border border-[#eadfd4] bg-white/90 p-2 shadow-xl backdrop-blur-xl dark:border-white/10 dark:bg-[#0f1116]/95">
                        {{-- Header --}}
                        <div class="border-b border-[#eadfd4] px-3 py-2.5 dark:border-white/10">
                            <p class="truncate text-sm font-bold">{{ $resolvedAdminName }}</p>
                            <p class="truncate text-[11px] text-[#6e5a50] dark:text-[#9a6c4c]">{{ Auth::user()->email ?? '' }}</p>
                        </div>

                        {{-- Settings --}}
                        <a
                            href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}"
                            @click="profileOpen = false"
                            class="mt-1 flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-sm font-medium text-[#51423a] transition-colors hover:bg-black/5 dark:text-white/70 dark:hover:bg-white/5"
                        >
                            <span class="material-symbols-outlined text-[18px]">settings</span>
                            Settings
                        </a>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button
                                type="submit"
                                class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2.5 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10"
                            >
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@once
    <script>
        (function () {
            const root = document.documentElement;
            const key = 'homeliving-admin-theme';
            const toggleBtn = document.getElementById('theme-toggle-btn');
            const toggleIcon = document.getElementById('theme-toggle-icon');

            function applyTheme(theme) {
                if (theme === 'light') {
                    root.classList.remove('dark');
                    root.classList.add('light');
                } else {
                    root.classList.remove('light');
                    root.classList.add('dark');
                }

                if (toggleIcon) {
                    toggleIcon.textContent = root.classList.contains('dark') ? 'light_mode' : 'dark_mode';
                }
            }

            const saved = localStorage.getItem(key);
            if (saved === 'light' || saved === 'dark') {
                applyTheme(saved);
            } else {
                applyTheme(root.classList.contains('dark') ? 'dark' : 'light');
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    const next = root.classList.contains('dark') ? 'light' : 'dark';
                    applyTheme(next);
                    localStorage.setItem(key, next);
                });
            }
        })();
    </script>
@endonce
