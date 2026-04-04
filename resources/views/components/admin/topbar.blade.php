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

<header class="sticky top-0 z-40 border-b border-[#eadfd4] bg-white/70 px-4 py-4 backdrop-blur-xl dark:border-white/10 dark:bg-[#0b0d12]/85 lg:px-8">
    <div class="flex items-center justify-between gap-6">
        @if ($searchAction)
            <form method="GET" action="{{ $searchAction }}" class="w-full max-w-2xl">
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-[#8b7266] dark:text-[#9a6c4c]">search</span>
                    <input
                        name="{{ $searchName }}"
                        value="{{ $searchValue }}"
                        type="text"
                        placeholder="{{ $placeholder }}"
                        class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 pl-11 pr-4 text-sm text-[#1b1c1b] placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]"
                    />
                </div>
            </form>
        @else
            <div class="relative w-full max-w-2xl">
                <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-[#8b7266] dark:text-[#9a6c4c]">search</span>
                <input
                    type="text"
                    placeholder="{{ $placeholder }}"
                    class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 pl-11 pr-4 text-sm text-[#1b1c1b] placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]"
                />
            </div>
        @endif

        <div class="flex items-center gap-3">
            @if ($showThemeToggle)
                <button type="button" id="theme-toggle-btn" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-[#eadfd4] bg-white/70 text-[#1b1c1b] transition-colors hover:text-primary dark:border-white/10 dark:bg-white/5 dark:text-white/80">
                    <span id="theme-toggle-icon" class="material-symbols-outlined text-[19px]">light_mode</span>
                </button>
            @endif

            <button type="button" class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg border border-[#eadfd4] bg-white/70 text-[#1b1c1b] transition-colors hover:text-primary dark:border-white/10 dark:bg-white/5 dark:text-white/80">
                <span class="material-symbols-outlined text-[19px]">notifications</span>
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-primary"></span>
            </button>

            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-[#eadfd4] bg-white/70 text-[#1b1c1b] transition-colors hover:text-primary dark:border-white/10 dark:bg-white/5 dark:text-white/80">
                <span class="material-symbols-outlined text-[19px]">mail</span>
            </button>

            <div class="ml-2 border-l border-[#eadfd4] pl-4 dark:border-white/10">
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-bold leading-tight">{{ $resolvedAdminName }}</p>
                        <p class="text-[10px] uppercase tracking-[0.16em] text-[#6e5a50] dark:text-[#9a6c4c]">{{ $adminRole }}</p>
                    </div>
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($resolvedAdminName) }}&background=0B5C80&color=fff"
                        alt="{{ $resolvedAdminName }}"
                        class="h-10 w-10 rounded-full border border-white/60 object-cover shadow"
                    />
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
