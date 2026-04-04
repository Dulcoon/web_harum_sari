<div
    wire:key="user-management-{{ md5(($search ?? '') . '|' . ($role ?? 'all') . '|' . ($verification ?? 'all') . '|' . ($users->currentPage() ?? 1)) }}"
    x-data="userManager({
        users: @js($userPayload),
        baseUserUrl: @js(url('/users')),
        openCreateFromQuery: @js(request()->boolean('create')),
        openEditIdFromQuery: @js(request()->query('edit')),
        oldMode: @js(old('form_mode')),
        oldEditUserId: @js(old('edit_user_id')),
        oldFields: @js([
            'name' => old('name'),
            'email' => old('email'),
            'role' => old('role'),
            'verification_status' => old('verification_status'),
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
            <h1 class="text-4xl font-extrabold tracking-tight">User Management</h1>
            <p class="mt-1 text-sm text-[#6e5a50] dark:text-[#b89983]">Manage admin and customer access with clean, centralized controls.</p>
        </div>
        <button
            type="button"
            @click="openCreate()"
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary to-primary-deep px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95"
        >
            <span class="material-symbols-outlined text-[18px]">add</span>
            Add New User
        </button>
    </div>

    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <article class="rounded-2xl border border-[#eadfd4] bg-white/70 p-5 dark:border-white/10 dark:bg-white/5">
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:text-[#9a6c4c]">Total Users</p>
            <p class="mt-2 text-3xl font-extrabold">{{ number_format($counts['all']) }}</p>
        </article>
        <article class="rounded-2xl border border-[#eadfd4] bg-white/70 p-5 dark:border-white/10 dark:bg-white/5">
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:text-[#9a6c4c]">Admins</p>
            <p class="mt-2 text-3xl font-extrabold">{{ number_format($counts['admin']) }}</p>
        </article>
        <article class="rounded-2xl border border-[#eadfd4] bg-white/70 p-5 dark:border-white/10 dark:bg-white/5">
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:text-[#9a6c4c]">Customers</p>
            <p class="mt-2 text-3xl font-extrabold">{{ number_format($counts['customer']) }}</p>
        </article>
        <article class="rounded-2xl border border-[#eadfd4] bg-white/70 p-5 dark:border-white/10 dark:bg-white/5">
            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:text-[#9a6c4c]">Verified</p>
            <p class="mt-2 text-3xl font-extrabold">{{ number_format($counts['verified']) }}</p>
        </article>
    </section>

    <div class="relative z-40 grid grid-cols-1 gap-3 overflow-visible rounded-3xl glass-panel p-5 lg:grid-cols-12 lg:items-center">
        <div class="relative lg:col-span-7">
            <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[#8b7266] dark:text-[#9a6c4c]">search</span>
            <input
                type="text"
                wire:model.defer="search"
                placeholder="Search by name or email..."
                class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 pl-11 pr-4 text-sm text-[#1b1c1b] placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]"
            />
        </div>

        <div class="relative lg:col-span-2" x-data="{ open: false, value: $wire.entangle('role'), options: [{ value: 'all', label: 'Role: All' }, { value: 'admin', label: 'Role: Admin' }, { value: 'customer', label: 'Role: Customer' }] }" @keydown.escape.window="open = false">
            <button
                type="button"
                @click="open = !open"
                class="inline-flex h-11 w-full items-center justify-between rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm text-[#4e4139] transition-colors hover:bg-white focus:border-primary focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-white/80"
            >
                <span x-text="(options.find((item) => item.value === value)?.label) ?? 'Role: All'"></span>
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

        <div class="relative lg:col-span-2" x-data="{ open: false, value: $wire.entangle('verification'), options: [{ value: 'all', label: 'Status: All' }, { value: 'verified', label: 'Status: Verified' }, { value: 'unverified', label: 'Status: Unverified' }] }" @keydown.escape.window="open = false">
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

        <button
            type="button"
            wire:click="applyFilters"
            wire:loading.attr="disabled"
            wire:target="applyFilters"
            class="h-11 rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-xs font-semibold uppercase tracking-wider text-[#4e4139] transition-colors hover:bg-white disabled:cursor-not-allowed disabled:opacity-60 dark:border-white/10 dark:bg-white/5 dark:text-white lg:col-span-1"
        >
            <span wire:loading.remove wire:target="applyFilters">Apply</span>
            <span wire:loading wire:target="applyFilters">Loading...</span>
        </button>
    </div>

    <section class="relative z-10 rounded-3xl glass-table p-6">
        <div wire:loading.flex wire:target="applyFilters,previousPage,nextPage,gotoPage" class="pointer-events-none absolute inset-0 z-20 items-center justify-center rounded-3xl bg-white/45 backdrop-blur-sm dark:bg-black/30">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-2 text-sm font-semibold text-[#4e4139] shadow dark:bg-[#0f1116]/90 dark:text-white">
                <span class="h-4 w-4 animate-spin rounded-full border-2 border-primary border-t-transparent"></span>
                Loading users...
            </div>
        </div>

        <div class="overflow-x-auto" wire:loading.class="opacity-60" wire:target="applyFilters,previousPage,nextPage,gotoPage">
            <table class="w-full min-w-[920px]">
                <thead>
                    <tr class="border-b border-[#eadfd4] text-left text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:border-white/10 dark:text-[#9a6c4c]">
                        <th class="pb-4">User</th>
                        <th class="pb-4">Role</th>
                        <th class="pb-4">Verification</th>
                        <th class="pb-4">Joined</th>
                        <th class="pb-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#efe6dd] dark:divide-white/10">
                    @forelse($users as $user)
                        @php
                            $role = $user->role ?? 'customer';
                            $isVerified = ! is_null($user->email_verified_at);
                            $roleBadgeClass = $role === 'admin'
                                ? 'bg-primary/15 text-primary border border-primary/20'
                                : 'bg-blue-500/10 text-blue-700 dark:text-blue-300 border border-blue-500/20';
                            $verificationBadgeClass = $isVerified
                                ? 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/25'
                                : 'bg-gray-500/15 text-gray-600 dark:text-gray-400 border border-gray-500/20';
                            $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=994200&color=fff';
                        @endphp
                        <tr wire:key="user-row-{{ $user->id }}" class="hover:bg-white/30 dark:hover:bg-white/5">
                            <td class="py-5">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $avatar }}" alt="{{ $user->name }}" class="h-11 w-11 rounded-full border border-[#eadfd4] object-cover dark:border-white/10">
                                    <div>
                                        <p class="text-sm font-bold leading-tight">{{ $user->name }}</p>
                                        <p class="mt-1 text-xs text-[#8b7266] dark:text-[#9a6c4c]">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $roleBadgeClass }}">
                                    {{ $role }}
                                </span>
                            </td>
                            <td class="py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $verificationBadgeClass }}">
                                    {{ $isVerified ? 'Verified' : 'Unverified' }}
                                </span>
                            </td>
                            <td class="py-5 text-sm text-[#4e4139] dark:text-white/75">
                                {{ $user->created_at?->format('d M Y, H:i') ?? '-' }}
                            </td>
                            <td class="py-5">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('users.edit', $user) }}"
                                        @click="openEdit({ id: {{ $user->id }}, name: @js($user->name), email: @js($user->email), role: @js($role), verification_status: @js($isVerified ? 'verified' : 'unverified') })"
                                        @click.prevent
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#eadfd4] bg-white/70 text-[#7d6758] transition-colors hover:text-primary dark:border-white/10 dark:bg-white/5 dark:text-white/70"
                                        aria-label="Edit {{ $user->name }}"
                                    >
                                        <span class="material-symbols-outlined text-[17px]">edit</span>
                                    </a>

                                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            @click.prevent="openDelete({ id: {{ $user->id }}, name: @js($user->name) })"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#eadfd4] bg-white/70 text-[#7d6758] transition-colors hover:text-red-600 dark:border-white/10 dark:bg-white/5 dark:text-white/70"
                                            aria-label="Delete {{ $user->name }}"
                                        >
                                            <span class="material-symbols-outlined text-[17px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-sm text-[#6e5a50] dark:text-[#b89983]">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col gap-4 border-t border-[#eadfd4] pt-5 text-sm text-[#6e5a50] dark:border-white/10 dark:text-[#b89983] md:flex-row md:items-center md:justify-between">
            <p>Showing {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users</p>

            @if($users->hasPages())
                <div class="flex items-center gap-2 rounded-full border border-[#eadfd4] bg-white/60 px-2 py-1.5 dark:border-white/10 dark:bg-white/5">
                    <button type="button" wire:click="previousPage" class="inline-flex h-8 w-8 items-center justify-center rounded-full transition-colors {{ $users->onFirstPage() ? 'pointer-events-none opacity-40' : 'hover:bg-white dark:hover:bg-white/10' }}">
                        <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                    </button>

                    @for($page = 1; $page <= $users->lastPage(); $page++)
                        @if($page === 1 || $page === $users->lastPage() || abs($page - $users->currentPage()) <= 1)
                            <button type="button" wire:click="gotoPage({{ $page }})" class="inline-flex h-9 min-w-[2.25rem] items-center justify-center rounded-xl px-2 text-sm font-semibold {{ $page === $users->currentPage() ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-[#4e4139] hover:bg-white dark:text-white/80 dark:hover:bg-white/10' }}">
                                {{ $page }}
                            </button>
                        @elseif($page === 2 && $users->currentPage() > 3)
                            <span class="px-1">...</span>
                        @elseif($page === $users->lastPage() - 1 && $users->currentPage() < $users->lastPage() - 2)
                            <span class="px-1">...</span>
                        @endif
                    @endfor

                    <button type="button" wire:click="nextPage" class="inline-flex h-8 w-8 items-center justify-center rounded-full transition-colors {{ $users->hasMorePages() ? 'hover:bg-white dark:hover:bg-white/10' : 'pointer-events-none opacity-40' }}">
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <div x-cloak x-show="createOpen" class="fixed inset-0 z-[90] flex items-center justify-center p-4" @keydown.escape.window="createOpen = false">
        <div class="absolute inset-0 bg-black/35" @click="createOpen = false"></div>
        <div class="relative w-full max-w-2xl rounded-2xl glass-panel p-6 md:p-8">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="text-2xl font-semibold">Add New User</h4>
                <button @click="createOpen = false" class="rounded-full p-2 transition-colors hover:bg-white/40" type="button">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form method="POST" action="{{ route('users.store') }}" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf
                <input type="hidden" name="form_mode" value="create">

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Name</label>
                    <input type="text" name="name" x-model="createForm.name" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Email</label>
                    <input type="email" name="email" x-model="createForm.email" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Role</label>
                    <select name="role" x-model="createForm.role" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5">
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Verification</label>
                    <select name="verification_status" x-model="createForm.verification_status" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5">
                        <option value="unverified">Unverified</option>
                        <option value="verified">Verified</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Password</label>
                    <input type="password" name="password" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div class="md:col-span-2 mt-2 flex items-center justify-end gap-3">
                    <button type="button" @click="createOpen = false" class="rounded-xl border border-[#eadfd4] bg-white/70 px-5 py-3 text-sm font-semibold text-[#51423a] transition-colors hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-white/80">Cancel</button>
                    <button type="submit" class="rounded-xl bg-gradient-to-r from-primary to-primary-deep px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95">Create User</button>
                </div>
            </form>
        </div>
    </div>

    <div x-cloak x-show="editOpen" class="fixed inset-0 z-[95] flex items-center justify-center p-4" @keydown.escape.window="editOpen = false">
        <div class="absolute inset-0 bg-black/35" @click="editOpen = false"></div>
        <div class="relative w-full max-w-2xl rounded-2xl glass-panel p-6 md:p-8">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="text-2xl font-semibold">Edit User</h4>
                <button @click="editOpen = false" class="rounded-full p-2 transition-colors hover:bg-white/40" type="button">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form method="POST" :action="`${baseUserUrl}/${editForm.id}`" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_mode" value="edit">
                <input type="hidden" name="edit_user_id" :value="editForm.id">

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Name</label>
                    <input type="text" name="name" x-model="editForm.name" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Email</label>
                    <input type="email" name="email" x-model="editForm.email" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5" required>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Role</label>
                    <select name="role" x-model="editForm.role" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5">
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Verification</label>
                    <select name="verification_status" x-model="editForm.verification_status" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5">
                        <option value="unverified">Unverified</option>
                        <option value="verified">Verified</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">New Password (Optional)</label>
                    <input type="password" name="password" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c]">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="h-11 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-3 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5">
                </div>

                <div class="md:col-span-2 mt-2 flex items-center justify-end gap-3">
                    <button type="button" @click="editOpen = false" class="rounded-xl border border-[#eadfd4] bg-white/70 px-5 py-3 text-sm font-semibold text-[#51423a] transition-colors hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-white/80">Cancel</button>
                    <button type="submit" class="rounded-xl bg-gradient-to-r from-primary to-primary-deep px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div x-cloak x-show="deleteOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4" @keydown.escape.window="deleteOpen = false">
        <div class="absolute inset-0 bg-black/45" @click="deleteOpen = false"></div>
        <div class="relative w-full max-w-md rounded-2xl glass-panel p-6">
            <h4 class="text-xl font-bold">Delete User</h4>
            <p class="mt-2 text-sm text-[#6e5a50] dark:text-[#b89983]">
                This action will permanently remove <span class="font-semibold text-[#1b1c1b] dark:text-white" x-text="deleteTarget?.name"></span>.
            </p>
            <div class="mt-5 flex items-center justify-end gap-3">
                <button type="button" @click="deleteOpen = false" class="rounded-xl border border-[#eadfd4] bg-white/70 px-4 py-2.5 text-sm font-semibold text-[#51423a] hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-white/80">Cancel</button>
                <form method="POST" :action="`${baseUserUrl}/${deleteTarget?.id ?? ''}`">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
