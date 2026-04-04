<x-admin.layout
    title="User Management"
    html-class="dark"
    topbar-placeholder="Search users..."
    :topbar-search-action="route('users.index')"
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

    <livewire:admin.user-management />

    <x-slot:scripts>
        <script>
            function userManager(config) {
                return {
                    users: config.users || [],
                    baseUserUrl: config.baseUserUrl,
                    createOpen: false,
                    editOpen: false,
                    deleteOpen: false,
                    deleteTarget: null,
                    createForm: {
                        name: '',
                        email: '',
                        role: 'customer',
                        verification_status: 'unverified',
                    },
                    editForm: {
                        id: null,
                        name: '',
                        email: '',
                        role: 'customer',
                        verification_status: 'unverified',
                    },
                    init() {
                        if (config.openCreateFromQuery || config.oldMode === 'create') {
                            this.openCreate();
                            this.applyOldToCreate();
                        }

                        if (config.oldMode === 'edit' && config.oldEditUserId) {
                            const user = this.users.find((item) => item.id === Number(config.oldEditUserId));
                            if (user) {
                                this.openEdit(user);
                                this.applyOldToEdit();
                            }
                        } else if (config.openEditIdFromQuery) {
                            const user = this.users.find((item) => item.id === Number(config.openEditIdFromQuery));
                            if (user) {
                                this.openEdit(user);
                            }
                        }
                    },
                    openCreate() {
                        this.createForm = {
                            name: '',
                            email: '',
                            role: 'customer',
                            verification_status: 'unverified',
                        };
                        this.createOpen = true;
                    },
                    openEdit(user) {
                        this.editForm = {
                            id: user.id,
                            name: user.name ?? '',
                            email: user.email ?? '',
                            role: user.role ?? 'customer',
                            verification_status: user.verification_status ?? 'unverified',
                        };
                        this.editOpen = true;
                    },
                    openDelete(user) {
                        this.deleteTarget = { ...user };
                        this.deleteOpen = true;
                    },
                    applyOldToCreate() {
                        const oldFields = config.oldFields || {};
                        this.createForm.name = oldFields.name ?? this.createForm.name;
                        this.createForm.email = oldFields.email ?? this.createForm.email;
                        this.createForm.role = oldFields.role ?? this.createForm.role;
                        this.createForm.verification_status = oldFields.verification_status ?? this.createForm.verification_status;
                    },
                    applyOldToEdit() {
                        const oldFields = config.oldFields || {};
                        this.editForm.name = oldFields.name ?? this.editForm.name;
                        this.editForm.email = oldFields.email ?? this.editForm.email;
                        this.editForm.role = oldFields.role ?? this.editForm.role;
                        this.editForm.verification_status = oldFields.verification_status ?? this.editForm.verification_status;
                    },
                };
            }
        </script>
    </x-slot:scripts>
</x-admin.layout>

