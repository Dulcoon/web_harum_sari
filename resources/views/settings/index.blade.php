<x-admin.layout
    title="General Settings"
    html-class="dark"
    topbar-placeholder="Search settings..."
    admin-role="Administrator"
>
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold tracking-tight">General Settings</h1>
        <p class="mt-1 text-sm text-[#6e5a50] dark:text-[#b89983]">Configure your store name, logo, contact info, and more.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
        @csrf

        <article class="rounded-3xl border border-[#eadfd4] bg-white/70 p-7 shadow-sm dark:border-white/10 dark:bg-white/5">
            <h2 class="text-xl font-bold tracking-tight mb-6">Store Identity</h2>

            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="store_name">Store Name</label>
                    <input id="store_name" name="store_name" type="text" value="{{ old('store_name', $settings['store_name']) }}" required
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="store_tagline">Tagline</label>
                    <input id="store_tagline" name="store_tagline" type="text" value="{{ old('store_tagline', $settings['store_tagline']) }}"
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2">Store Logo</label>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 rounded-2xl border border-[#eadfd4] overflow-hidden bg-white/50 flex items-center justify-center dark:border-white/10">
                            @if ($settings['store_logo'])
                                <img src="{{ $settings['store_logo'] }}" alt="Logo" class="w-full h-full object-contain">
                            @else
                                <span class="text-2xl font-black text-[#8b7266]">HL</span>
                            @endif
                        </div>
                        <div>
                            <label class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-[#eadfd4] text-sm font-medium cursor-pointer hover:bg-black/5 dark:border-white/10 dark:text-white dark:hover:bg-white/5">
                                <span class="material-symbols-outlined text-base">upload</span>
                                Upload Logo
                                <input type="file" name="store_logo" accept="image/*" class="hidden">
                            </label>
                            <p class="mt-1 text-[11px] text-[#8b7266] dark:text-[#9a6c4c]">Recommended: 200x200px, max 2MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <article class="rounded-3xl border border-[#eadfd4] bg-white/70 p-7 shadow-sm dark:border-white/10 dark:bg-white/5">
            <h2 class="text-xl font-bold tracking-tight mb-6">Contact & Currency</h2>

            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="contact_email">Contact Email</label>
                    <input id="contact_email" name="contact_email" type="email" value="{{ old('contact_email', $settings['contact_email']) }}"
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="whatsapp_number">WhatsApp Number</label>
                    <input id="whatsapp_number" name="whatsapp_number" type="text" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="+628123456789"
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="default_currency">Default Currency</label>
                    <select id="default_currency" name="default_currency"
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white">
                        @foreach (['IDR' => 'Indonesian Rupiah (Rp)', 'USD' => 'US Dollar ($)', 'EUR' => 'Euro (€)', 'SGD' => 'Singapore Dollar (S$)'] as $code => $label)
                            <option value="{{ $code }}" @selected(old('default_currency', $settings['default_currency']) === $code)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </article>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="h-12 px-8 rounded-xl bg-[#d46211] hover:bg-[#994200] text-white font-bold text-sm shadow-[0_10px_20px_-5px_rgba(212,98,17,0.3)] transition-all hover:scale-[1.01] active:scale-95">
                Save Settings
            </button>
        </div>
    </form>

    <x-slot:scripts>
        <script>
            // Admin settings - theme persistence
            (function () {
                const root = document.documentElement;
                const key = 'homeliving-admin-theme';
                const saved = localStorage.getItem(key);
                if (saved === 'dark' || saved === 'light') {
                    root.classList.remove('dark', 'light');
                    root.classList.add(saved);
                }
            })();
        </script>
    </x-slot:scripts>
</x-admin.layout>
