<header class="sticky top-0 z-50 glass-morphism border-b border-black/10 dark:border-white/5 px-4 lg:px-20 transition-all duration-300">
    <div class="max-w-[1440px] mx-auto flex items-center justify-between h-20 gap-4">
        <div class="flex items-center gap-3 min-w-0">
            <a href="{{ route('homepage.home') }}" class="w-10 h-10 bg-premium-gradient flex items-center justify-center rounded-xl text-white shadow-lg shadow-primary/30 shrink-0">
                <span class="material-symbols-outlined">chair</span>
            </a>
            <a href="{{ route('homepage.home') }}" class="text-xl font-extrabold tracking-tight truncate text-[#1b1c1b] dark:text-white">HOMELIVING</a>
        </div>

        <nav class="hidden md:flex items-center gap-10">
            <a class="text-sm font-bold {{ Route::is('homepage.home') ? 'text-primary' : 'text-[#2e251f] dark:text-white/80' }} hover:text-primary transition-colors" href="{{ route('homepage.home') }}">Home</a>
            <a class="text-sm font-bold {{ Route::is('homepage.product') || Route::is('product.detail') || Route::is('products.detail') || Route::is('productss') ? 'text-primary' : 'text-[#2e251f] dark:text-white/80' }} transition-colors" href="{{ route('homepage.product') }}">Product</a>
            <a class="text-sm font-bold {{ Route::is('email.form') ? 'text-primary' : 'text-[#2e251f] dark:text-white/80' }} hover:text-primary transition-colors" href="{{ route('email.form') }}">Contact Us</a>
        </nav>

        <div class="flex items-center gap-2 sm:gap-4">
            <div class="hidden lg:flex items-center bg-black/[0.03] dark:bg-white/5 rounded-2xl px-5 py-2.5 border border-black/10 dark:border-white/10 focus-within:border-primary/50 transition-all shadow-inner relative w-80">
                <span class="material-symbols-outlined text-primary text-xl mr-2">search</span>
                <input
                    id="nav-search-input"
                    type="text"
                    autocomplete="off"
                    placeholder="Search curated pieces..."
                    class="w-full bg-transparent border-none focus:ring-0 text-sm placeholder:text-[#806553] dark:placeholder:text-white/30 text-[#2a2019] dark:text-white"
                />

                <div id="nav-search-results" class="absolute left-0 top-full mt-2 w-full rounded-2xl border border-black/10 dark:border-white/10 bg-white/95 dark:bg-[#2a1d14] shadow-lg hidden overflow-hidden z-20 backdrop-blur-xl">
                    <ul class="text-sm"></ul>
                </div>
            </div>

            <button type="button" class="hidden md:inline-flex p-2.5 hover:bg-black/5 dark:hover:bg-white/5 rounded-full transition-all relative" aria-label="Wishlist">
                <span class="material-symbols-outlined text-[#2a2019] dark:text-white/80">favorite</span>
            </button>

            <button id="theme-toggle-btn" type="button" class="p-2.5 hover:bg-black/5 dark:hover:bg-white/5 rounded-full transition-all relative" aria-label="Toggle dark mode">
                <span id="theme-toggle-icon" class="material-symbols-outlined text-[#2a2019] dark:text-white/80">light_mode</span>
            </button>

            @auth
                <a href="{{ route('profile.edit') }}" class="hidden xl:inline-flex p-2.5 hover:bg-black/5 dark:hover:bg-white/5 rounded-full transition-all relative" aria-label="Profile">
                    <span class="material-symbols-outlined text-[#2a2019] dark:text-white/80">person</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden xl:inline-flex p-2.5 hover:bg-black/5 dark:hover:bg-white/5 rounded-full transition-all relative" aria-label="Login">
                    <span class="material-symbols-outlined text-[#2a2019] dark:text-white/80">login</span>
                </a>
            @endauth

            <a href="{{ route('cart.index') }}" class="p-2.5 bg-black/[0.04] hover:bg-black/[0.08] dark:bg-white/5 dark:hover:bg-white/10 rounded-full transition-all relative" aria-label="Cart">
                <span class="material-symbols-outlined text-[#2a2019] dark:text-white/80">shopping_bag</span>
                @if(session('cart_count', 0) > 0)
                    <span class="absolute top-1 right-1 w-4 h-4 bg-premium-gradient text-white text-[10px] flex items-center justify-center rounded-full font-bold shadow-sm shadow-primary/40">{{ session('cart_count') }}</span>
                @endif
            </a>
        </div>
    </div>
</header>

<script>
    (function () {
        const themeToggleBtn = document.getElementById('theme-toggle-btn');
        const themeToggleIcon = document.getElementById('theme-toggle-icon');
        const searchInput = document.getElementById('nav-search-input');
        const searchResults = document.getElementById('nav-search-results');
        const root = document.documentElement;
        const themeStorageKey = 'homeliving-theme';

        const applyTheme = (theme) => {
            if (theme === 'dark') {
                root.classList.add('dark');
                root.classList.remove('light');
            } else {
                root.classList.remove('dark');
                root.classList.add('light');
            }

            if (themeToggleIcon) {
                themeToggleIcon.textContent = theme === 'dark' ? 'light_mode' : 'dark_mode';
            }
        };

        const savedTheme = localStorage.getItem(themeStorageKey);
        if (savedTheme === 'dark' || savedTheme === 'light') {
            applyTheme(savedTheme);
        } else {
            applyTheme(root.classList.contains('dark') ? 'dark' : 'light');
        }

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function () {
                const nextTheme = root.classList.contains('dark') ? 'light' : 'dark';
                applyTheme(nextTheme);
                localStorage.setItem(themeStorageKey, nextTheme);
            });
        }

        if (!searchInput || !searchResults) {
            return;
        }

        const resultList = searchResults.querySelector('ul');

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }

            fetch(`{{ route('products.search.suggestions') }}?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultList.innerHTML = '';

                    if (!Array.isArray(data) || data.length === 0) {
                        searchResults.classList.add('hidden');
                        return;
                    }

                    data.forEach(product => {
                        const detailRoute = "{{ route('product.detail', ':id') }}".replace(':id', product.id);
                        const imageSrc = product.foto ? `/storage/${product.foto}` : "{{ asset('assets/no_image.png') }}";

                        const li = document.createElement('li');
                        li.innerHTML = `
                            <a href="${detailRoute}" class="flex items-center gap-3 px-4 py-3 hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                                <img src="${imageSrc}" class="w-10 h-10 object-cover rounded-md" alt="${product.nama}">
                                <div class="min-w-0">
                                    <p class="font-semibold text-xs truncate text-[#1b1c1b] dark:text-white">${product.nama}</p>
                                    <p class="text-xs text-primary">Rp ${new Intl.NumberFormat('id-ID').format(product.harga)}</p>
                                </div>
                            </a>
                        `;
                        resultList.appendChild(li);
                    });

                    searchResults.classList.remove('hidden');
                })
                .catch(() => {
                    searchResults.classList.add('hidden');
                });
        });

        document.addEventListener('click', function (event) {
            if (!searchResults.contains(event.target) && !searchInput.contains(event.target)) {
                searchResults.classList.add('hidden');
            }
        });
    })();
</script>
