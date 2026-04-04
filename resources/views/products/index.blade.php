<x-admin.layout
    title="Product Management"
    html-class="dark"
    topbar-placeholder="Search products..."
    :topbar-search-action="route('products.index')"
    topbar-search-name="q"
    :topbar-search-value="request('q', '')"
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

            .glass-table {
                background: rgba(255, 255, 255, 0.56);
                border: 1px solid rgba(255, 255, 255, 0.62);
                box-shadow: 0 8px 28px rgba(31, 38, 135, 0.08);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }

            html.dark .glass-panel,
            html.dark .glass-table {
                background: rgba(15, 17, 22, 0.7);
                border-color: rgba(255, 255, 255, 0.08);
                box-shadow: 0 14px 34px rgba(0, 0, 0, 0.35);
            }

            [x-cloak] {
                display: none !important;
            }
        </style>
    </x-slot:head>

    <livewire:admin.product-management />

    <x-slot:scripts>
        <script>
            function productManager(config) {
                return {
                    products: config.products || [],
                    baseProductUrl: config.baseProductUrl,
                    defaultThumb: config.defaultThumb,
                    createOpen: false,
                    editOpen: false,
                    deleteOpen: false,
                    deleteTarget: null,
                    createPreview: config.defaultThumb,
                    editPreview: config.defaultThumb,
                    editForm: {
                        id: null,
                        nama: '',
                        harga: '',
                        deskripsi: '',
                        kategori_id: '',
                        featured_products: '1',
                        stok: 0,
                    },
                    init() {
                        if (config.openCreateFromQuery || config.oldMode === 'create') {
                            this.createOpen = true;
                        }

                        if (config.oldMode === 'edit' && config.oldEditProductId) {
                            const product = this.products.find((item) => item.id === Number(config.oldEditProductId));
                            if (product) {
                                this.openEdit(product);
                                this.applyOldFieldsToEdit();
                            }
                        } else if (config.openEditIdFromQuery) {
                            const product = this.products.find((item) => item.id === Number(config.openEditIdFromQuery));
                            if (product) {
                                this.openEdit(product);
                            }
                        }
                    },
                    openEdit(product) {
                        this.editForm = {
                            id: product.id,
                            nama: product.nama ?? '',
                            harga: product.harga ?? '',
                            deskripsi: product.deskripsi ?? '',
                            kategori_id: String(product.kategori_id ?? ''),
                            featured_products: String(product.featured_products ?? 1),
                            stok: product.stok ?? 0,
                        };
                        this.editPreview = product.foto || this.defaultThumb;
                        this.editOpen = true;
                    },
                    openDelete(product) {
                        this.deleteTarget = { ...product };
                        this.deleteOpen = true;
                    },
                    applyOldFieldsToEdit() {
                        const oldFields = config.oldFields || {};
                        this.editForm.nama = oldFields.nama ?? this.editForm.nama;
                        this.editForm.harga = oldFields.harga ?? this.editForm.harga;
                        this.editForm.deskripsi = oldFields.deskripsi ?? this.editForm.deskripsi;
                        this.editForm.kategori_id = oldFields.kategori_id ? String(oldFields.kategori_id) : this.editForm.kategori_id;
                        this.editForm.featured_products = oldFields.featured_products !== null && oldFields.featured_products !== undefined
                            ? String(oldFields.featured_products)
                            : this.editForm.featured_products;
                        this.editForm.stok = oldFields.stok ?? this.editForm.stok;
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
                            return;
                        }
                        this.editPreview = URL.createObjectURL(file);
                    },
                };
            }
        </script>
    </x-slot:scripts>
</x-admin.layout>
