@php
    $categoriesPayload = $kategories->map(function ($category) {
        return [
            'id' => (string) $category->id,
            'label' => 'Category: ' . $category->nama,
        ];
    })->values();
@endphp

<div
    x-data="productManager({
        products: @js($productPayload),
        baseProductUrl: @js(url('/products')),
        defaultThumb: @js($defaultThumb),
        openCreateFromQuery: @js(request()->boolean('create')),
        openEditIdFromQuery: @js(request()->query('edit')),
        oldMode: @js(old('form_mode')),
        oldEditProductId: @js(old('edit_product_id')),
        oldFields: @js([
            'nama' => old('nama'),
            'harga' => old('harga'),
            'deskripsi' => old('deskripsi'),
            'kategori_id' => old('kategori_id'),
            'featured_products' => old('featured_products'),
            'stok' => old('stok'),
        ]),
    })"
    class="space-y-8"
>
    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-semibold">Please fix the following:</p>
            <ul class="mt-1 list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight">Product Management</h1>
            <p class="mt-1 text-sm text-[#6e5a50] dark:text-[#b89983]">Manage and curate your digital showroom inventory.</p>
        </div>
        <button
            type="button"
            @click="createOpen = true"
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary to-primary-deep px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95"
        >
            <span class="material-symbols-outlined text-[18px]">add</span>
            Add New Product
        </button>
    </div>

    <div class="relative z-40 grid grid-cols-1 gap-3 overflow-visible rounded-3xl glass-panel p-5 lg:grid-cols-12 lg:items-center">
        <div class="relative lg:col-span-7">
            <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[#8b7266] dark:text-[#9a6c4c]">filter_alt</span>
            <input
                type="text"
                wire:model.defer="search"
                placeholder="Filter by product name..."
                class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 pl-11 pr-4 text-sm text-[#1b1c1b] placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]"
            />
        </div>

        <div class="relative lg:col-span-2" x-data="{ open: false, value: $wire.entangle('status'), options: [{ value: 'all', label: 'Status: All' }, { value: 'active', label: 'Status: Active' }, { value: 'draft', label: 'Status: Draft' }, { value: 'out_of_stock', label: 'Status: Out of Stock' }] }" @keydown.escape.window="open = false">
            <button
                type="button"
                @click="open = !open"
                class="inline-flex h-11 w-full items-center justify-between rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm text-[#4e4139] transition-colors hover:bg-white focus:border-primary focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-white/80"
            >
                <span x-text="(options.find((item) => item.value === value)?.label) ?? 'Status: All'"></span>
                <span class="material-symbols-outlined text-[18px] transition-transform" :class="open ? 'rotate-180 text-primary' : 'text-[#8b7266] dark:text-[#9a6c4c]'">expand_more</span>
            </button>

            <div
                x-cloak
                x-show="open"
                @click.outside="open = false"
                class="absolute left-0 right-0 z-[80] mt-2 overflow-hidden rounded-xl border border-[#eadfd4] bg-white/95 p-1.5 shadow-lg backdrop-blur dark:border-white/10 dark:bg-[#131722]/95"
            >
                <template x-for="option in options" :key="option.value">
                    <button
                        type="button"
                        @click="value = option.value; open = false"
                        class="flex w-full items-center rounded-lg px-3 py-2 text-left text-sm transition-colors"
                        :class="value === option.value ? 'bg-primary/10 text-primary dark:bg-primary/15' : 'text-[#4e4139] hover:bg-black/5 dark:text-white/80 dark:hover:bg-white/10'"
                        x-text="option.label"
                    ></button>
                </template>
            </div>
        </div>

        <div class="relative lg:col-span-2" x-data="{ open: false, value: $wire.entangle('kategoriId'), options: @js($categoriesPayload) }" @keydown.escape.window="open = false">
            <button
                type="button"
                @click="open = !open"
                class="inline-flex h-11 w-full items-center justify-between rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm text-[#4e4139] transition-colors hover:bg-white focus:border-primary focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-white/80"
            >
                <span class="truncate" x-text="value ? (options.find((item) => item.id === value)?.label ?? 'Category: All') : 'Category: All'"></span>
                <span class="material-symbols-outlined text-[18px] transition-transform" :class="open ? 'rotate-180 text-primary' : 'text-[#8b7266] dark:text-[#9a6c4c]'">expand_more</span>
            </button>

            <div
                x-cloak
                x-show="open"
                @click.outside="open = false"
                class="absolute left-0 right-0 z-[80] mt-2 max-h-64 overflow-y-auto rounded-xl border border-[#eadfd4] bg-white/95 p-1.5 shadow-lg backdrop-blur dark:border-white/10 dark:bg-[#131722]/95"
            >
                <button
                    type="button"
                    @click="value = ''; open = false"
                    class="flex w-full items-center rounded-lg px-3 py-2 text-left text-sm transition-colors"
                    :class="value === '' ? 'bg-primary/10 text-primary dark:bg-primary/15' : 'text-[#4e4139] hover:bg-black/5 dark:text-white/80 dark:hover:bg-white/10'"
                >
                    Category: All
                </button>
                <template x-for="option in options" :key="option.id">
                    <button
                        type="button"
                        @click="value = option.id; open = false"
                        class="flex w-full items-center rounded-lg px-3 py-2 text-left text-sm transition-colors"
                        :class="value === option.id ? 'bg-primary/10 text-primary dark:bg-primary/15' : 'text-[#4e4139] hover:bg-black/5 dark:text-white/80 dark:hover:bg-white/10'"
                        x-text="option.label"
                    ></button>
                </template>
            </div>
        </div>

        <button
            type="button"
            wire:click="applyFilters"
            wire:loading.attr="disabled"
            wire:target="applyFilters,status,kategoriId,search"
            class="h-11 rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-xs font-semibold uppercase tracking-wider text-[#4e4139] transition-colors hover:bg-white disabled:cursor-not-allowed disabled:opacity-60 dark:border-white/10 dark:bg-white/5 dark:text-white lg:col-span-1"
        >
            <span wire:loading.remove wire:target="applyFilters,status,kategoriId,search">Apply</span>
            <span wire:loading wire:target="applyFilters,status,kategoriId,search">Loading...</span>
        </button>
    </div>

    <section class="relative z-10 rounded-3xl glass-table p-6">
        <div wire:loading.flex wire:target="applyFilters,previousPage,nextPage,gotoPage,status,kategoriId,search" class="absolute inset-0 z-20 items-center justify-center rounded-3xl bg-white/45 backdrop-blur-sm dark:bg-black/30">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-2 text-sm font-semibold text-[#4e4139] shadow dark:bg-[#0f1116]/90 dark:text-white">
                <span class="h-4 w-4 animate-spin rounded-full border-2 border-primary border-t-transparent"></span>
                Loading products...
            </div>
        </div>

        <div class="overflow-x-auto" wire:loading.class="opacity-60" wire:target="applyFilters,previousPage,nextPage,gotoPage,status,kategoriId,search">
            <table class="w-full min-w-[920px]">
                <thead>
                    <tr class="border-b border-[#eadfd4] text-left text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:border-white/10 dark:text-[#9a6c4c]">
                        <th class="pb-4">Product</th>
                        <th class="pb-4">Category</th>
                        <th class="pb-4">Price</th>
                        <th class="pb-4">Stock Level</th>
                        <th class="pb-4">Status</th>
                        <th class="pb-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#efe6dd] dark:divide-white/10">
                    @forelse($products as $product)
                        @php
                            $imageUrl = $product->foto ? asset('storage/' . ltrim($product->foto, '/')) : $defaultThumb;
                            $progress = $stockMax > 0 ? (int) round(($product->stok / $stockMax) * 100) : 0;
                            $statusBadgeClass = $product->featured_products
                                ? 'bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/25'
                                : 'bg-gray-500/15 text-gray-600 dark:text-gray-400 border border-gray-500/20';
                        @endphp
                        <tr class="hover:bg-white/30 dark:hover:bg-white/5">
                            <td class="py-5">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $imageUrl }}" alt="{{ $product->nama }}" class="h-14 w-14 rounded-xl border border-[#eadfd4] object-cover dark:border-white/10">
                                    <div>
                                        <p class="text-sm font-bold leading-tight">{{ $product->nama }}</p>
                                        <p class="mt-1 text-xs text-[#8b7266] dark:text-[#9a6c4c]">SKU: HL-2024-{{ str_pad((string) $product->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5">
                                <span class="inline-flex rounded-full border border-[#eadfd4] bg-white/70 px-3 py-1 text-xs text-[#4e4139] dark:border-white/10 dark:bg-white/5 dark:text-white/80">
                                    {{ $product->kategori?->nama ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="py-5 text-xl font-semibold">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="py-5">
                                <div class="flex items-center gap-3">
                                    <div class="h-1.5 w-28 overflow-hidden rounded-full bg-[#dccfc4] dark:bg-white/10">
                                        <div class="h-full rounded-full bg-primary" style="width: {{ max(0, min(100, $progress)) }}%"></div>
                                    </div>
                                    @if($product->stok > 0)
                                        <span class="text-sm font-medium">{{ $product->stok }} left</span>
                                    @else
                                        <span class="text-sm font-semibold text-red-600 dark:text-red-400">Out of Stock</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusBadgeClass }}">
                                    {{ $product->featured_products ? 'Active' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-5">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        @click="openEdit({ id: {{ $product->id }}, nama: @js($product->nama), harga: {{ (float) $product->harga }}, deskripsi: @js($product->deskripsi), kategori_id: '{{ (string) $product->kategori_id }}', featured_products: '{{ (int) $product->featured_products }}', stok: {{ (int) $product->stok }}, foto: @js($imageUrl) })"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#eadfd4] bg-white/70 text-[#7d6758] transition-colors hover:text-primary dark:border-white/10 dark:bg-white/5 dark:text-white/70"
                                        aria-label="Edit {{ $product->nama }}"
                                    >
                                        <span class="material-symbols-outlined text-[17px]">edit</span>
                                    </button>
                                    <button
                                        type="button"
                                        @click="openDelete({ id: {{ $product->id }}, nama: @js($product->nama) })"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#eadfd4] bg-white/70 text-[#7d6758] transition-colors hover:text-red-600 dark:border-white/10 dark:bg-white/5 dark:text-white/70"
                                        aria-label="Delete {{ $product->nama }}"
                                    >
                                        <span class="material-symbols-outlined text-[17px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-sm text-[#6e5a50] dark:text-[#b89983]">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col gap-4 border-t border-[#eadfd4] pt-5 text-sm text-[#6e5a50] dark:border-white/10 dark:text-[#b89983] md:flex-row md:items-center md:justify-between">
            <p>Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</p>

            @if($products->hasPages())
                <div class="flex items-center gap-2 rounded-full border border-[#eadfd4] bg-white/60 px-2 py-1.5 dark:border-white/10 dark:bg-white/5">
                    <button type="button" wire:click="previousPage" class="inline-flex h-8 w-8 items-center justify-center rounded-full transition-colors {{ $products->onFirstPage() ? 'pointer-events-none opacity-40' : 'hover:bg-white dark:hover:bg-white/10' }}">
                        <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                    </button>

                    @for($page = 1; $page <= $products->lastPage(); $page++)
                        @if($page === 1 || $page === $products->lastPage() || abs($page - $products->currentPage()) <= 1)
                            <button type="button" wire:click="gotoPage({{ $page }})" class="inline-flex h-9 min-w-[2.25rem] items-center justify-center rounded-xl px-2 text-sm font-semibold {{ $page === $products->currentPage() ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-[#4e4139] hover:bg-white dark:text-white/80 dark:hover:bg-white/10' }}">
                                {{ $page }}
                            </button>
                        @elseif($page === 2 && $products->currentPage() > 3)
                            <span class="px-1">...</span>
                        @elseif($page === $products->lastPage() - 1 && $products->currentPage() < $products->lastPage() - 2)
                            <span class="px-1">...</span>
                        @endif
                    @endfor

                    <button type="button" wire:click="nextPage" class="inline-flex h-8 w-8 items-center justify-center rounded-full transition-colors {{ $products->hasMorePages() ? 'hover:bg-white dark:hover:bg-white/10' : 'pointer-events-none opacity-40' }}">
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <div x-cloak x-show="createOpen" class="fixed inset-0 z-[90] flex items-center justify-center p-4" @keydown.escape.window="createOpen = false">
        <div class="absolute inset-0 bg-black/35" @click="createOpen = false"></div>
        <div class="relative w-full max-w-3xl rounded-2xl glass-panel p-6 md:p-8">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="text-2xl font-semibold">Add New Product</h4>
                <button @click="createOpen = false" class="rounded-full p-2 transition-colors hover:bg-white/40" type="button">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf
                <input type="hidden" name="form_mode" value="create">

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Product Name</label>
                    <input type="text" name="nama" value="{{ old('form_mode') === 'create' ? old('nama') : '' }}" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Price</label>
                    <input type="number" step="0.01" min="0" name="harga" value="{{ old('form_mode') === 'create' ? old('harga') : '' }}" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Category</label>
                    <select name="kategori_id" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                        <option value="">Select category</option>
                        @foreach($kategories as $category)
                            <option value="{{ $category->id }}" @selected(old('form_mode') === 'create' && (string) old('kategori_id') === (string) $category->id)>{{ $category->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Stock</label>
                    <input type="number" min="0" name="stok" value="{{ old('form_mode') === 'create' ? old('stok', 0) : 0 }}" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Status</label>
                    <select name="featured_products" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                        <option value="1" @selected(old('form_mode') === 'create' ? (string) old('featured_products', '1') === '1' : true)>Active</option>
                        <option value="0" @selected(old('form_mode') === 'create' && (string) old('featured_products') === '0')>Draft</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Description</label>
                    <textarea name="deskripsi" rows="4" class="w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 py-2 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>{{ old('form_mode') === 'create' ? old('deskripsi') : '' }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Photo</label>
                    <div class="overflow-hidden rounded-2xl border border-[#eadfd4] bg-white/30 dark:border-white/10 dark:bg-white/5">
                        <img :src="createPreview" alt="New Product" class="h-48 w-full object-cover">
                    </div>
                    <input type="file" name="foto" accept="image/*" @change="updateCreatePreview" class="mt-3 block w-full rounded-xl border border-[#eadfd4] bg-white/70 p-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div class="flex justify-end gap-3 md:col-span-2">
                    <button type="button" @click="createOpen = false" class="rounded-xl border border-[#eadfd4] bg-white/70 px-5 py-2.5 text-sm font-semibold dark:border-white/10 dark:bg-white/5">Cancel</button>
                    <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25">Create Product</button>
                </div>
            </form>
        </div>
    </div>

    <div x-cloak x-show="editOpen" class="fixed inset-0 z-[92] flex items-center justify-center p-4" @keydown.escape.window="editOpen = false">
        <div class="absolute inset-0 bg-black/35" @click="editOpen = false"></div>
        <div class="relative w-full max-w-3xl rounded-2xl glass-panel p-6 md:p-8">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="text-2xl font-semibold">Edit Product</h4>
                <button @click="editOpen = false" class="rounded-full p-2 transition-colors hover:bg-white/40" type="button">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" :action="`${baseProductUrl}/${editForm.id}`" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_mode" value="edit">
                <input type="hidden" name="edit_product_id" :value="editForm.id">

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Product Name</label>
                    <input type="text" name="nama" x-model="editForm.nama" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Price</label>
                    <input type="number" step="0.01" min="0" name="harga" x-model="editForm.harga" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Category</label>
                    <select name="kategori_id" x-model="editForm.kategori_id" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                        <option value="">Select category</option>
                        @foreach($kategories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Stock</label>
                    <input type="number" min="0" name="stok" x-model="editForm.stok" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Status</label>
                    <select name="featured_products" x-model="editForm.featured_products" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                        <option value="1">Active</option>
                        <option value="0">Draft</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Description</label>
                    <textarea name="deskripsi" rows="4" x-model="editForm.deskripsi" class="w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 py-2 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Photo</label>
                    <div class="overflow-hidden rounded-2xl border border-[#eadfd4] bg-white/30 dark:border-white/10 dark:bg-white/5">
                        <img :src="editPreview" alt="Edit Product" class="h-48 w-full object-cover">
                    </div>
                    <input type="file" name="foto" accept="image/*" @change="updateEditPreview" class="mt-3 block w-full rounded-xl border border-[#eadfd4] bg-white/70 p-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary dark:border-white/10 dark:bg-white/5">
                </div>

                <div class="flex justify-end gap-3 md:col-span-2">
                    <button type="button" @click="editOpen = false" class="rounded-xl border border-[#eadfd4] bg-white/70 px-5 py-2.5 text-sm font-semibold dark:border-white/10 dark:bg-white/5">Cancel</button>
                    <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div x-cloak x-show="deleteOpen" class="fixed inset-0 z-[95] flex items-center justify-center p-4" @keydown.escape.window="deleteOpen = false">
        <div class="absolute inset-0 bg-black/35" @click="deleteOpen = false"></div>
        <div class="relative w-full max-w-md rounded-2xl glass-panel p-6">
            <h4 class="text-xl font-semibold">Delete Product</h4>
            <p class="mt-2 text-sm text-[#6e5a50] dark:text-[#b89983]">
                Are you sure you want to delete <span class="font-semibold text-[#1b1c1b] dark:text-white" x-text="deleteTarget?.nama"></span>?
            </p>

            <form method="POST" :action="deleteTarget ? `${baseProductUrl}/${deleteTarget.id}` : '#'" class="mt-6 flex items-center justify-end gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="deleteOpen = false" class="rounded-xl border border-[#eadfd4] bg-white/70 px-4 py-2.5 text-sm font-semibold dark:border-white/10 dark:bg-white/5">Cancel</button>
                <button type="submit" class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>
