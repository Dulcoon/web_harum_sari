@php
    $defaultThumb = asset('assets/no_image.png');
    $categoryPayload = $categories->map(function ($category) use ($defaultThumb) {
        return [
            'id' => $category->id,
            'nama' => $category->nama,
            'products_count' => $category->products_count,
            'thumbnail' => $category->thumbnail ? asset('storage/' . $category->thumbnail) : $defaultThumb,
        ];
    })->values();
@endphp

<x-admin.layout
    title="Category Management"
    html-class="dark"
    topbar-placeholder="Search categories..."
    :topbar-search-action="route('category.index')"
    topbar-search-name="q"
    :topbar-search-value="$search"
    admin-role="Manager"
    content-class="px-4 pb-20 pt-8 lg:px-10"
>
    <x-slot:head>
        <style>
            .glass-panel {
                background: rgba(255, 255, 255, 0.45);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.5);
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.07);
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.6);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.7);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
                transition: all 0.35s ease;
            }

            .glass-card:hover {
                background: rgba(255, 255, 255, 0.78);
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
            }

            html.dark .glass-panel {
                background: rgba(15, 17, 22, 0.68);
                border-color: rgba(255, 255, 255, 0.08);
                box-shadow: 0 14px 34px rgba(0, 0, 0, 0.35);
            }

            html.dark .glass-card {
                background: rgba(28, 18, 12, 0.72);
                border-color: rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 26px rgba(0, 0, 0, 0.28);
            }

            html.dark .glass-card:hover {
                background: rgba(35, 22, 15, 0.86);
            }

            [x-cloak] {
                display: none !important;
            }
        </style>
    </x-slot:head>

    <div
        x-data="categoryManager({
            categories: @js($categoryPayload),
            baseCategoryUrl: @js(url('/category')),
            defaultThumb: @js($defaultThumb),
            oldMode: @js(old('form_mode')),
            oldEditCategoryId: @js(old('edit_category_id')),
            oldName: @js(old('nama')),
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
                <h2 class="text-4xl font-semibold tracking-tight">Categories</h2>
                <p class="mt-2 max-w-lg text-secondary">Organize your studio collection by architectural space and style with our curated management suite.</p>
            </div>
            <button @click="createOpen = true" class="inline-flex items-center gap-2 rounded-xl bg-primary px-8 py-3.5 font-semibold text-white shadow-xl shadow-primary/20 transition-all hover:scale-[1.01] active:scale-95" type="button">
                <span class="material-symbols-outlined">add</span>
                Add New Category
            </button>
        </div>

        <div class="grid grid-cols-1 gap-8 xl:grid-cols-12 xl:gap-10">
            <section class="space-y-8 xl:col-span-8">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    @forelse($categories as $category)
                        @php
                            $thumb = $category->thumbnail ? asset('storage/' . $category->thumbnail) : $defaultThumb;
                        @endphp
                        <article
                            @click="select({ id: {{ $category->id }}, nama: @js($category->nama), products_count: {{ $category->products_count }}, thumbnail: @js($thumb) })"
                            :class="selected.id === {{ $category->id }} ? 'ring-2 ring-accent/40 shadow-lg' : ''"
                            class="group relative cursor-pointer overflow-hidden rounded-2xl glass-card"
                        >
                            <div class="aspect-[4/3] overflow-hidden bg-white/40">
                                <img src="{{ $thumb }}" alt="{{ $category->nama }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
                            </div>
                            <div class="flex items-center justify-between bg-white/10 p-6 backdrop-blur-md">
                                <div>
                                    <h3 class="text-lg font-bold">{{ $category->nama }}</h3>
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-secondary">{{ $category->products_count }} Products</p>
                                </div>
                                <div class="flex translate-y-2 gap-1.5 opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                                    <button
                                        type="button"
                                        @click.stop="select({ id: {{ $category->id }}, nama: @js($category->nama), products_count: {{ $category->products_count }}, thumbnail: @js($thumb) })"
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white/80 text-[#574238] shadow-sm transition-all hover:bg-white"
                                        aria-label="Edit {{ $category->nama }}"
                                    >
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </button>
                                    <button
                                        type="button"
                                        @click.stop="openDelete({ id: {{ $category->id }}, nama: @js($category->nama) })"
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white/80 text-red-600 shadow-sm transition-all hover:bg-red-50"
                                        aria-label="Delete {{ $category->nama }}"
                                    >
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-white/60 bg-white/40 p-10 text-center text-sm text-secondary">
                            No categories found.
                        </div>
                    @endforelse
                </div>
            </section>

            <aside class="xl:col-span-4">
                <div class="sticky top-28 rounded-[2rem] glass-panel p-8">
                    <h3 class="mb-8 flex items-center gap-3 text-2xl font-semibold">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent">
                            <span class="material-symbols-outlined">edit_note</span>
                        </span>
                        Edit Category
                    </h3>

                    <template x-if="selected.id">
                        <form method="POST" enctype="multipart/form-data" :action="`${baseCategoryUrl}/${selected.id}`" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="form_mode" value="edit">
                            <input type="hidden" name="edit_category_id" :value="selected.id">

                            <div>
                                <label class="mb-2 block px-1 text-[10px] font-bold uppercase tracking-widest text-secondary">Category Name</label>
                                <input name="nama" x-model="selected.nama" class="w-full rounded-xl border border-white/40 bg-white/50 p-3.5 text-sm focus:ring-2 focus:ring-primary/20" required type="text">
                            </div>

                            <div>
                                <label class="mb-2 block px-1 text-[10px] font-bold uppercase tracking-widest text-secondary">Representative Image</label>
                                <div class="overflow-hidden rounded-2xl border border-white/60 bg-white/30">
                                    <img :src="selectedPreview" alt="Selected Category" class="h-44 w-full object-cover">
                                </div>
                                <input name="thumbnail" @change="updateEditPreview" accept="image/*" class="mt-3 block w-full rounded-xl border border-white/40 bg-white/50 p-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary" type="file">
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-2">
                                <button type="button" @click="resetSelected" class="rounded-xl border border-white/40 bg-white/60 px-4 py-3.5 text-sm font-bold transition-all hover:bg-white/80">Cancel</button>
                                <button type="submit" class="rounded-xl bg-primary px-4 py-3.5 text-sm font-bold text-white transition-all hover:shadow-lg hover:shadow-primary/20">Save Changes</button>
                            </div>
                        </form>
                    </template>

                    <template x-if="!selected.id">
                        <div class="rounded-2xl border border-dashed border-white/50 bg-white/20 p-6 text-sm text-secondary">
                            Select a category card to edit.
                        </div>
                    </template>
                </div>
            </aside>
        </div>

        @if($categories->hasPages())
            <div class="mt-16 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <p class="inline-flex w-fit rounded-full border border-white/40 bg-white/40 px-4 py-2 text-xs font-medium text-secondary">
                    Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories
                </p>

                <div class="flex items-center gap-2 rounded-full border border-white/40 bg-white/40 p-1.5">
                    <a href="{{ $categories->onFirstPage() ? '#' : $categories->previousPageUrl() }}" class="flex h-9 w-9 items-center justify-center rounded-full transition-colors {{ $categories->onFirstPage() ? 'pointer-events-none opacity-40' : 'hover:bg-white/60' }}">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </a>

                    @for($page = 1; $page <= $categories->lastPage(); $page++)
                        @if($page === 1 || $page === $categories->lastPage() || abs($page - $categories->currentPage()) <= 1)
                            <a href="{{ $categories->url($page) }}" class="flex h-9 min-w-[2.25rem] items-center justify-center rounded-full px-2 text-xs font-bold transition-colors {{ $page === $categories->currentPage() ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'hover:bg-white/60' }}">
                                {{ $page }}
                            </a>
                        @elseif($page === 2 && $categories->currentPage() > 3)
                            <span class="px-1 text-xs text-secondary">...</span>
                        @elseif($page === $categories->lastPage() - 1 && $categories->currentPage() < $categories->lastPage() - 2)
                            <span class="px-1 text-xs text-secondary">...</span>
                        @endif
                    @endfor

                    <a href="{{ $categories->hasMorePages() ? $categories->nextPageUrl() : '#' }}" class="flex h-9 w-9 items-center justify-center rounded-full transition-colors {{ $categories->hasMorePages() ? 'hover:bg-white/60' : 'pointer-events-none opacity-40' }}">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                </div>
            </div>
        @endif

        <div x-cloak x-show="createOpen" class="fixed inset-0 z-[90] flex items-center justify-center p-4" @keydown.escape.window="createOpen = false">
            <div class="absolute inset-0 bg-black/35" @click="createOpen = false"></div>
            <div class="relative w-full max-w-xl rounded-2xl glass-panel p-6 md:p-8">
                <div class="mb-5 flex items-center justify-between">
                    <h4 class="text-2xl font-semibold">Add New Category</h4>
                    <button @click="createOpen = false" class="rounded-full p-2 transition-colors hover:bg-white/50" type="button">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="hidden" name="form_mode" value="create">

                    <div>
                        <label class="mb-2 block px-1 text-[10px] font-bold uppercase tracking-widest text-secondary">Category Name</label>
                        <input name="nama" value="{{ old('form_mode') === 'create' ? old('nama') : '' }}" class="w-full rounded-xl border border-white/40 bg-white/50 p-3.5 text-sm focus:ring-2 focus:ring-primary/20" required type="text">
                    </div>

                    <div>
                        <label class="mb-2 block px-1 text-[10px] font-bold uppercase tracking-widest text-secondary">Representative Image</label>
                        <div class="overflow-hidden rounded-2xl border border-white/60 bg-white/30">
                            <img :src="createPreview" alt="New Category" class="h-52 w-full object-cover">
                        </div>
                        <input name="thumbnail" @change="updateCreatePreview" accept="image/*" class="mt-3 block w-full rounded-xl border border-white/40 bg-white/50 p-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary" required type="file">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-1">
                        <button type="button" @click="createOpen = false" class="rounded-xl border border-white/40 bg-white/60 px-5 py-3 text-sm font-bold transition-all hover:bg-white/80">Cancel</button>
                        <button type="submit" class="rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white transition-all hover:shadow-lg hover:shadow-primary/20">Create Category</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-cloak x-show="deleteOpen" class="fixed inset-0 z-[95] flex items-center justify-center p-4" @keydown.escape.window="deleteOpen = false">
            <div class="absolute inset-0 bg-black/35" @click="deleteOpen = false"></div>
            <div class="relative w-full max-w-md rounded-2xl glass-panel p-6">
                <h4 class="text-xl font-semibold">Delete Category</h4>
                <p class="mt-2 text-sm text-secondary">Are you sure you want to delete <span class="font-semibold text-[#1b1c1b]" x-text="deleteTarget?.nama"></span>? This will also remove products under this category.</p>

                <form method="POST" :action="deleteTarget ? `${baseCategoryUrl}/${deleteTarget.id}` : '#'" class="mt-6 flex items-center justify-end gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="deleteOpen = false" class="rounded-xl border border-white/40 bg-white/60 px-4 py-2.5 text-sm font-bold transition-all hover:bg-white/80">Cancel</button>
                    <button type="submit" class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition-all hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            function categoryManager(config) {
                return {
                    categories: config.categories || [],
                    baseCategoryUrl: config.baseCategoryUrl,
                    defaultThumb: config.defaultThumb,
                    selected: { id: null, nama: '', products_count: 0, thumbnail: config.defaultThumb },
                    selectedPreview: config.defaultThumb,
                    createOpen: false,
                    createPreview: config.defaultThumb,
                    deleteOpen: false,
                    deleteTarget: null,
                    init() {
                        if (this.categories.length > 0) {
                            this.select(this.categories[0]);
                        }

                        if (config.oldEditCategoryId) {
                            const fromOld = this.categories.find((item) => item.id === Number(config.oldEditCategoryId));
                            if (fromOld) {
                                this.select(fromOld);
                            }
                        }

                        if (config.oldName && this.selected.id) {
                            this.selected.nama = config.oldName;
                        }

                        if (config.oldMode === 'create') {
                            this.createOpen = true;
                        }
                    },
                    select(category) {
                        this.selected = { ...category };
                        this.selectedPreview = category.thumbnail || this.defaultThumb;
                    },
                    resetSelected() {
                        if (!this.categories.length) {
                            this.selected = { id: null, nama: '', products_count: 0, thumbnail: this.defaultThumb };
                            this.selectedPreview = this.defaultThumb;
                            return;
                        }
                        this.select(this.categories[0]);
                    },
                    updateCreatePreview(event) {
                        const [file] = event.target.files || [];
                        if (!file) {
                            this.createPreview = this.defaultThumb;
                            return;
                        }
                        this.createPreview = URL.createObjectURL(file);
                    },
                    updateEditPreview(event) {
                        const [file] = event.target.files || [];
                        if (!file) {
                            this.selectedPreview = this.selected.thumbnail || this.defaultThumb;
                            return;
                        }
                        this.selectedPreview = URL.createObjectURL(file);
                    },
                    openDelete(category) {
                        this.deleteTarget = category;
                        this.deleteOpen = true;
                    },
                }
            }
        </script>
    </x-slot:scripts>
</x-admin.layout>
