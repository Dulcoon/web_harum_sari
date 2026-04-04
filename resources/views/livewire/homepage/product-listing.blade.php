<div class="relative z-10 max-w-[1440px] mx-auto px-4 lg:px-10 py-8 lg:py-10">
    <main class="pb-10">
        @php
            $safeMaxPrice = max((int) ($dbMaxPrice ?? 1), 1);
            $currentMaxPrice = min(max((int) ($maxPrice ?? 0), 0), $safeMaxPrice);
            $pricePercent = ($currentMaxPrice / $safeMaxPrice) * 100;
        @endphp

        <section class="lg:hidden mb-7" x-data="{ showMobileFilters: false }"
            @mobile-filter-applied.window="showMobileFilters = false">
            <h2 class="text-[3.75rem] leading-[0.95] font-black tracking-tight text-[#1b1c1b] dark:text-white mb-5">
                Curated<br />Living Space</h2>
            <div class="flex items-center gap-3">
                <div
                    class="flex-1 flex items-center rounded-2xl px-4 py-3 border border-black/10 dark:border-white/10 bg-white/70 dark:bg-white/5">
                    <span class="material-symbols-outlined text-primary mr-2 text-[20px]">search</span>
                    <input
                        class="w-full bg-transparent border-none focus:ring-0 text-sm text-[#1b1c1b] dark:text-white placeholder:text-[#8a7568] dark:placeholder:text-white/30"
                        placeholder="Search curated pieces..." type="text" />
                </div>

                <div class="relative shrink-0" @keydown.escape.window="showMobileFilters = false">
                    <button type="button" aria-controls="mobile-filter-panel"
                        :aria-expanded="showMobileFilters.toString()" @click="showMobileFilters = !showMobileFilters"
                        class="w-12 h-12 flex items-center justify-center bg-premium-gradient text-white rounded-2xl shadow-lg shadow-primary/30 transition-all">
                        <span class="material-symbols-outlined">tune</span>
                    </button>

                    <div id="mobile-filter-panel" x-cloak x-show="showMobileFilters" x-transition.origin.top.right
                        @click.outside="showMobileFilters = false"
                        class="absolute top-full right-0 mt-3 z-30 w-[min(92vw,23rem)] glass-morphism rounded-2xl p-4 shadow-warm">
                        <p class="text-[11px] uppercase tracking-[0.14em] font-black text-primary/80 mb-3">Quick Filters
                        </p>

                        <div class="flex gap-2 overflow-x-auto hide-scrollbar pb-1 mb-4">
                            <button type="button" wire:click="$set('kategoriId', null)"
                                class="px-3 py-1.5 rounded-full text-xs font-bold border {{ is_null($kategoriId) ? 'bg-premium-gradient text-white border-transparent' : 'border-black/10 dark:border-white/20 text-[#6a5548] dark:text-white/70' }}">All</button>
                            @foreach($kategories as $kategori)
                                <button type="button" wire:click="$set('kategoriId', {{ $kategori->id }})"
                                    class="px-3 py-1.5 rounded-full text-xs font-bold border whitespace-nowrap {{ $kategoriId === $kategori->id ? 'bg-premium-gradient text-white border-transparent' : 'border-black/10 dark:border-white/20 text-[#6a5548] dark:text-white/70' }}">{{ $kategori->nama }}</button>
                            @endforeach
                        </div>

                        <div class="price-range-wrapper mb-4">
                            <div class="flex justify-between text-xs font-bold text-[#7d695b] dark:text-white/50 mb-2">
                                <span>Rp 0</span>
                                <span data-price-display>Rp {{ number_format($maxPrice ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="relative h-1.5 bg-black/10 dark:bg-white/10 rounded-full mb-1">
                                <input wire:model.change="maxPrice"
                                    class="price-range-input absolute inset-0 w-full cursor-pointer z-10"
                                    max="{{ $dbMaxPrice }}" min="0" step="50000" oninput="
                                        const wrapper = this.closest('.price-range-wrapper');
                                        const value = Number(this.value);
                                        const max = Number(this.max) || 1;
                                        const pct = Math.min(100, Math.max(0, (value / max) * 100));
                                        const label = wrapper?.querySelector('[data-price-display]');
                                        if (label) label.textContent = 'Rp ' + value.toLocaleString('id-ID');
                                        this.style.setProperty('--range-progress', pct + '%');
                                    " style="--range-progress: {{ $pricePercent }}%;" type="range" />
                            </div>
                        </div>

                        <select wire:model.live="sort"
                            class="dark-select w-full rounded-xl border border-black/10 dark:border-white/15 bg-white/70 dark:bg-white/5 px-3 py-2.5 text-xs font-bold text-[#2a2019] dark:text-white focus:border-primary focus:ring-0">
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]" value="newest">
                                Newest Arrivals</option>
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]" value="price_asc">
                                Price: Low to High</option>
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]"
                                value="price_desc">Price: High to Low</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-10">
            <aside class="hidden lg:block w-72 space-y-6 shrink-0">
                <div class="glass-morphism rounded-2xl p-5 shadow-warm">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-primary/80 mb-4">Featured Selection
                    </p>
                    <div class="relative aspect-[4/5] rounded-xl overflow-hidden mb-5 group">
                        <img src="{{ asset('assets/hero.png') }}" alt="Featured collection"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 brightness-90" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                        <button type="button"
                            class="absolute top-3 right-3 w-9 h-9 glass-morphism !bg-black/40 rounded-full flex items-center justify-center text-primary shadow-lg">
                            <span class="material-symbols-outlined text-xl">favorite</span>
                        </button>
                    </div>

                    <h4 class="font-bold text-base text-[#1b1c1b] dark:text-white">Nordic Summer Collection</h4>
                    <p class="text-sm font-extrabold premium-text-gradient mt-1">Starting from Rp
                        {{ number_format(($products->first()->harga ?? 0), 0, ',', '.') }}</p>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="w-full bg-black/10 dark:bg-white/10 h-2 rounded-full overflow-hidden">
                            <div
                                class="bg-premium-gradient h-full w-[35%] rounded-full shadow-[0_0_12px_rgba(212,98,17,0.6)]">
                            </div>
                        </div>
                        <span class="text-xs font-black ml-3 text-primary">35%</span>
                    </div>
                </div>

                <div class="glass-morphism rounded-2xl p-6 shadow-sm price-range-panel">
                    <h4 class="text-xs font-black uppercase tracking-[0.15em] mb-6 text-[#6a5548] dark:text-white/50">
                        Price Range</h4>
                    <div class="flex justify-between mb-5">
                        <div class="flex flex-col">
                            <span
                                class="text-[10px] text-[#8a7568] dark:text-white/40 font-bold uppercase mb-1">Min</span>
                            <span class="text-base font-black text-[#1b1c1b] dark:text-white">Rp 0</span>
                        </div>
                        <div class="flex flex-col text-right">
                            <span
                                class="text-[10px] text-[#8a7568] dark:text-white/40 font-bold uppercase mb-1">Max</span>
                            <span class="text-base font-black text-[#1b1c1b] dark:text-white"
                                data-price-display-desktop>Rp {{ number_format($maxPrice ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="price-range-wrapper relative h-1.5 bg-black/10 dark:bg-white/10 rounded-full mb-8">
                        <input wire:model.change="maxPrice"
                            class="price-range-input absolute inset-0 w-full cursor-pointer z-10"
                            max="{{ $dbMaxPrice }}" min="0" step="50000" oninput="
                                const panel = this.closest('.price-range-panel');
                                const value = Number(this.value);
                                const max = Number(this.max) || 1;
                                const pct = Math.min(100, Math.max(0, (value / max) * 100));
                                const label = panel?.querySelector('[data-price-display-desktop]');
                                if (label) label.textContent = 'Rp ' + value.toLocaleString('id-ID');
                                this.style.setProperty('--range-progress', pct + '%');
                            " style="--range-progress: {{ $pricePercent }}%;" type="range" />
                    </div>

                    <button type="button"
                        class="w-full bg-premium-gradient text-white font-bold text-xs py-4 rounded-xl transition-all shadow-lg shadow-primary/20 hover:shadow-primary/50 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                        Apply Filters <span class="material-symbols-outlined text-sm">tune</span>
                    </button>
                </div>

                <div class="glass-morphism rounded-2xl p-6 shadow-sm">
                    <h4 class="text-xs font-black uppercase tracking-[0.15em] mb-6 text-[#6a5548] dark:text-white/50">
                        Categories</h4>
                    <div class="space-y-4">
                        <button type="button" wire:click="$set('kategoriId', null)"
                            class="w-full flex items-center justify-between cursor-pointer group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="relative w-5 h-5 flex items-center justify-center rounded-full border-2 {{ is_null($kategoriId) ? 'border-primary' : 'border-black/20 dark:border-white/20' }}">
                                    <div
                                        class="w-2.5 h-2.5 bg-premium-gradient rounded-full {{ is_null($kategoriId) ? '' : 'opacity-0' }}">
                                    </div>
                                </div>
                                <span
                                    class="text-sm font-semibold {{ is_null($kategoriId) ? 'text-primary' : 'text-[#3a302a] dark:text-white/70' }} group-hover:text-primary transition-colors">All
                                    Products</span>
                            </div>
                            <span
                                class="text-[10px] font-bold text-[#8a7568] dark:text-white/30">{{ $products->total() }}</span>
                        </button>

                        @foreach($kategories as $kategori)
                            <button type="button" wire:click="$set('kategoriId', {{ $kategori->id }})"
                                class="w-full flex items-center justify-between cursor-pointer group">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="relative w-5 h-5 flex items-center justify-center rounded-full border-2 {{ $kategoriId === $kategori->id ? 'border-primary' : 'border-black/20 dark:border-white/20' }}">
                                        <div
                                            class="w-2.5 h-2.5 bg-premium-gradient rounded-full {{ $kategoriId === $kategori->id ? '' : 'opacity-0' }}">
                                        </div>
                                    </div>
                                    <span
                                        class="text-sm font-semibold {{ $kategoriId === $kategori->id ? 'text-primary' : 'text-[#3a302a] dark:text-white/70' }} group-hover:text-primary transition-colors">{{ $kategori->nama }}</span>
                                </div>
                                <span
                                    class="text-[10px] font-bold text-[#8a7568] dark:text-white/30">{{ $kategori->products_count ?? 0 }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </aside>

            <section class="flex-1 space-y-8">
                <div
                    class="relative glass-morphism rounded-[2.5rem] p-7 md:p-10 lg:p-14 overflow-hidden shadow-warm flex flex-col md:flex-row items-center gap-8 min-h-[320px]">
                    <div class="absolute -top-20 -right-20 w-72 h-72 bg-orange-500/20 rounded-full blur-[80px]"></div>
                    <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-primary/15 rounded-full blur-[80px]"></div>

                    <div class="z-10 flex-1 space-y-5 text-center md:text-left">
                        <span
                            class="inline-block px-4 py-1 rounded-full bg-primary/20 text-primary text-[10px] font-black uppercase tracking-widest border border-primary/20">Seasonal
                            Sale</span>
                        <h2
                            class="text-4xl md:text-6xl font-black leading-[1.05] tracking-tight text-[#1b1c1b] dark:text-white">
                            Get 20% discount on<br /><span class="premium-text-gradient">New Arrivalllllss</span></h2>
                        <p class="text-[#6a5548] dark:text-white/60 text-base font-medium max-w-md">Elevate your living
                            space with our latest handcrafted Scandinavian furniture collection.</p>
                        <div class="flex flex-wrap gap-3 pt-1 justify-center md:justify-start">
                            <a href="{{ route('homepage.product') }}"
                                class="bg-white dark:bg-white text-background-dark px-8 py-3.5 rounded-2xl font-black text-sm shadow-xl hover:scale-105 transition-all duration-300">Explore
                                Now</a>
                            <button type="button"
                                class="glass-morphism px-7 py-3.5 rounded-2xl font-black text-sm hover:bg-white/10 transition-all text-[#1b1c1b] dark:text-white border-white/10">View
                                Lookbook</button>
                        </div>
                    </div>

                    <div class="relative w-full md:w-1/2 flex items-center justify-center">
                        <div class="absolute w-56 h-56 bg-premium-gradient/30 rounded-full blur-[50px] animate-pulse">
                        </div>
                        <img src="{{ asset('assets/Gemini_Generated_Image_meakqgmeakqgmeak.png') }}" alt="Hero Sofa"
                            class="relative z-10 w-full max-w-[360px] drop-shadow-[0_35px_35px_rgba(212,98,17,0.35)] hover:rotate-2 transition-transform duration-700" />
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="glass-morphism rounded-2xl p-4 md:p-5 flex items-center gap-3 md:gap-4">
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-white/5 rounded-xl flex items-center justify-center text-[#6a5548] dark:text-white/50">
                            <span class="material-symbols-outlined">grid_view</span></div>
                        <div>
                            <h5 class="text-xl font-black leading-none text-[#1b1c1b] dark:text-white">
                                {{ $kategories->count() }}</h5>
                            <p class="text-[10px] font-bold text-[#8a7568] dark:text-white/40 uppercase tracking-wider">
                                Categories</p>
                        </div>
                    </div>

                    <div
                        class="glass-morphism rounded-2xl p-4 md:p-5 flex items-center gap-3 md:gap-4 relative overflow-hidden shadow-warm">
                        <div
                            class="absolute top-0 left-0 w-1 h-full bg-premium-gradient shadow-[0_0_8px_rgba(212,98,17,0.6)]">
                        </div>
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-primary/20 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">chair</span></div>
                        <div>
                            <h5 class="text-xl font-black leading-none text-[#1b1c1b] dark:text-white">
                                {{ $products->total() }}</h5>
                            <p class="text-[10px] font-bold text-primary uppercase tracking-wider">Products</p>
                        </div>
                    </div>

                    <div class="glass-morphism rounded-2xl p-4 md:p-5 flex items-center gap-3 md:gap-4">
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-white/5 rounded-xl flex items-center justify-center text-[#6a5548] dark:text-white/50">
                            <span class="material-symbols-outlined">storefront</span></div>
                        <div>
                            <h5 class="text-xl font-black leading-none text-[#1b1c1b] dark:text-white">15</h5>
                            <p class="text-[10px] font-bold text-[#8a7568] dark:text-white/40 uppercase tracking-wider">
                                Stores</p>
                        </div>
                    </div>

                    <div class="glass-morphism rounded-2xl p-4 md:p-5 flex items-center gap-3 md:gap-4">
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-white/5 rounded-xl flex items-center justify-center text-[#6a5548] dark:text-white/50">
                            <span class="material-symbols-outlined">person</span></div>
                        <div>
                            <h5 class="text-xl font-black leading-none text-[#1b1c1b] dark:text-white">1.8k</h5>
                            <p class="text-[10px] font-bold text-[#8a7568] dark:text-white/40 uppercase tracking-wider">
                                Fans</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 pt-1">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-premium-gradient text-white flex items-center justify-center rounded-xl shadow-lg shadow-primary/30">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        </div>
                        <p class="text-sm font-bold text-[#3a302a] dark:text-white/80">Curating <span
                                class="premium-text-gradient text-base font-black">{{ $products->total() }} premium
                                items</span></p>
                    </div>

                    <div class="flex items-center gap-3">
                        <select wire:model.live="sort"
                            class="dark-select bg-white/95 dark:bg-white/10 text-[#1b1c1b] dark:text-white px-5 py-3 rounded-2xl text-xs font-black shadow-xl hover:scale-105 transition-all border border-black/10 dark:border-white/15 focus:border-primary focus:ring-0">
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]" value="newest">
                                Filter & Sort</option>
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]" value="newest">
                                Newest Arrivals</option>
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]" value="price_asc">
                                Price: Low to High</option>
                            <option class="text-[#1b1c1b] dark:text-white bg-white dark:bg-[#2a1d14]"
                                value="price_desc">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div wire:loading.flex class="items-center justify-center py-12 text-sm font-semibold text-primary">
                    Loading products...</div>

                <div wire:loading.remove class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5 md:gap-8">
                    @forelse ($products as $product)
                        <article
                            class="product-glass-card rounded-3xl p-4 shadow-sm group transition-all duration-300 hover:-translate-y-1">
                            <div
                                class="product-media-shell relative aspect-square rounded-2xl overflow-hidden mb-4 md:mb-5 flex items-center justify-center p-4 md:p-8">
                                <img src="{{ $product->foto ? asset('storage/' . $product->foto) : asset('assets/no_image.png') }}"
                                    alt="{{ $product->nama }}"
                                    class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-1000" />

                                @if($loop->first)
                                    <span
                                        class="absolute top-3 left-3 bg-premium-gradient text-white text-[9px] md:text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-tighter shadow-lg shadow-primary/40">New</span>
                                @endif

                                <button type="button"
                                    class="absolute top-3 right-3 w-8 h-8 md:w-9 md:h-9 glass-morphism !bg-black/30 rounded-full flex items-center justify-center text-white/50 hover:text-primary transition-all hover:scale-110">
                                    <span class="material-symbols-outlined text-lg md:text-xl">favorite</span>
                                </button>

                                <a href="{{ route('product.detail', $product->id) }}"
                                    class="absolute bottom-3 right-3 w-8 h-8 md:w-9 md:h-9 bg-premium-gradient text-white rounded-xl flex items-center justify-center shadow-lg shadow-primary/30 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all">
                                    <span class="material-symbols-outlined text-base">add</span>
                                </a>
                            </div>

                            <div class="px-1 space-y-1.5">
                                <h3 class="font-bold text-sm md:text-base truncate text-[#1b1c1b] dark:text-white">
                                    {{ $product->nama }}</h3>
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-lg font-black premium-text-gradient">Rp
                                        {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    <span
                                        class="text-[9px] md:text-[10px] font-bold text-[#8a7568] dark:text-white/40 uppercase">{{ $loop->even ? 'Express' : 'Premium' }}</span>
                                </div>
                                <div class="pt-2 flex items-center gap-2 text-[#8a7568] dark:text-white/40">
                                    <span class="material-symbols-outlined text-sm">local_shipping</span>
                                    <span class="text-[9px] md:text-[10px] font-black uppercase tracking-wider">5-7 Days
                                        Delivery</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-14 text-[#6a5548] dark:text-white/60 font-semibold">Produk
                            tidak ditemukan untuk filter saat ini.</div>
                    @endforelse
                </div>

                <div class="mt-10 md:mt-14 pb-4">
                    {{ $products->links() }}
                </div>
            </section>
        </div>
    </main>
</div>