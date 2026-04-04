<x-admin.layout
    title="Dashboard"
    html-class="dark"
    topbar-placeholder="Search analytics..."
    :admin-name="$adminName"
    admin-role="Chief Curator"
    content-class="space-y-8 px-8 py-8"
>
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight">Workspace Overview</h1>
            <p class="mt-1 text-sm text-[#6e5a50] dark:text-[#b89983]">Welcome back. Here's what's happening in the atelier today.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" class="h-11 rounded-xl border border-[#eadfd4] bg-white/70 px-5 text-sm font-semibold text-[#1b1c1b] transition-colors hover:bg-white dark:border-white/10 dark:bg-white/5 dark:text-white">Export CSV</button>
            <button type="button" class="h-11 rounded-xl bg-gradient-to-r from-primary to-primary-deep px-5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition-transform hover:scale-[1.01] active:scale-95">Create Report</button>
        </div>
    </div>

    <section class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
        @foreach($summaryCards as $card)
            @php
                $trend = (float) $card['trend'];
                $isPositive = $trend > 0;
                $isNegative = $trend < 0;
                $trendBadgeClass = $isPositive
                    ? 'bg-emerald-500/15 text-emerald-500 border border-emerald-500/20'
                    : ($isNegative
                        ? 'bg-red-500/15 text-red-500 border border-red-500/20'
                        : 'bg-gray-500/15 text-gray-500 border border-gray-500/20');
                $trendPrefix = $isPositive ? '+' : '';
            @endphp
            <article class="rounded-2xl border border-[#eadfd4] bg-white/70 p-6 shadow-sm transition-transform hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/5 dark:shadow-none">
                <div class="mb-5 flex items-start justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[18px]">{{ $card['icon'] }}</span>
                    </div>
                    <span class="rounded-full px-2.5 py-1 text-[10px] font-bold {{ $trendBadgeClass }}">{{ $trendPrefix }}{{ number_format($trend, 1) }}%</span>
                </div>
                <p class="mb-1 text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:text-[#9a6c4c]">{{ $card['label'] }}</p>
                <h3 class="text-[2rem] font-extrabold leading-none tracking-tight">{{ $card['value'] }}</h3>
            </article>
        @endforeach
    </section>

    <section class="grid grid-cols-12 gap-6">
        <article class="col-span-12 rounded-3xl border border-[#eadfd4] bg-white/70 p-7 shadow-sm dark:border-white/10 dark:bg-white/5 lg:col-span-8">
            <div class="mb-6 flex items-center justify-between gap-3">
                <div>
                    <h3 class="text-3xl font-bold tracking-tight">Sales Statistics</h3>
                    <p class="text-sm text-[#6e5a50] dark:text-[#b89983]">Weekly performance tracking</p>
                </div>
                <div class="rounded-xl border border-[#eadfd4] bg-white/80 p-1 dark:border-white/10 dark:bg-white/5">
                    <button type="button" class="rounded-lg bg-white px-4 py-1.5 text-xs font-bold text-primary shadow-sm dark:bg-primary/15 dark:text-primary">Weekly</button>
                    <button type="button" class="rounded-lg px-4 py-1.5 text-xs font-bold text-[#6e5a50] dark:text-white/70">Monthly</button>
                </div>
            </div>

            <div class="relative h-[320px] overflow-hidden rounded-2xl border border-[#eadfd4] bg-white/60 p-6 dark:border-white/10 dark:bg-white/10">
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="pointer-events-none absolute inset-0 h-full w-full opacity-80">
                    <polyline points="{{ $salesChart['linePoints'] }}" fill="none" stroke="#d46211" stroke-opacity="0.55" stroke-width="1.8" />
                </svg>

                <div class="relative z-10 flex h-full items-end justify-between gap-4">
                    @foreach($salesChart['bars'] as $bar)
                        <div class="flex flex-1 flex-col items-center justify-end gap-3">
                            <div class="w-full max-w-[44px] rounded-t-xl {{ $bar['active'] ? 'bg-gradient-to-t from-primary to-orange-300 shadow-lg shadow-primary/25' : 'bg-gradient-to-t from-primary/25 to-primary/45' }}" style="height: {{ $bar['height'] }}px"></div>
                            <span class="text-[10px] font-extrabold uppercase tracking-[0.16em] {{ $bar['active'] ? 'text-primary' : 'text-[#6e5a50] dark:text-[#b89983]' }}">{{ $bar['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>

        <article class="col-span-12 rounded-3xl border border-[#eadfd4] bg-white/70 p-7 shadow-sm dark:border-white/10 dark:bg-white/5 lg:col-span-4">
            <h3 class="mb-5 text-3xl font-bold tracking-tight">Top Categories</h3>
            <div class="space-y-4">
                @forelse($topCategories as $category)
                    <div class="group flex items-center gap-3 rounded-2xl border border-[#eadfd4] bg-white/70 p-3 transition-colors hover:bg-white dark:border-white/10 dark:bg-white/5 dark:hover:bg-white/10">
                        <img src="{{ $category['thumbnail'] }}" alt="{{ $category['name'] }}" class="h-14 w-14 rounded-xl border border-[#eadfd4] object-cover dark:border-white/10" />
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-bold">{{ $category['name'] }}</p>
                            <p class="text-xs text-[#6e5a50] dark:text-[#b89983]">{{ $category['share'] }}% of total sales</p>
                        </div>
                        <span class="material-symbols-outlined text-primary opacity-0 transition-opacity group-hover:opacity-100">chevron_right</span>
                    </div>
                @empty
                    <p class="text-sm text-[#6e5a50] dark:text-[#b89983]">No category data available yet.</p>
                @endforelse
            </div>
        </article>

        <article class="col-span-12 rounded-3xl border border-[#eadfd4] bg-white/70 p-7 shadow-sm dark:border-white/10 dark:bg-white/5 lg:col-span-9">
            <div class="mb-6 flex items-center justify-between gap-4">
                <h3 class="text-3xl font-bold tracking-tight">Recent Orders</h3>
                <a href="#" class="text-xs font-bold uppercase tracking-[0.18em] text-primary">View All Orders</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px]">
                    <thead>
                        <tr class="border-b border-[#eadfd4] text-left text-[10px] font-bold uppercase tracking-[0.18em] text-[#8b7266] dark:border-white/10 dark:text-[#9a6c4c]">
                            <th class="pb-4">Order ID</th>
                            <th class="pb-4">Customer</th>
                            <th class="pb-4">Product</th>
                            <th class="pb-4">Date</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#efe6dd] dark:divide-white/10">
                        @forelse($recentOrders as $order)
                            @php
                                $status = strtolower((string) $order['status']);
                                $statusClass = match ($status) {
                                    'paid', 'completed', 'shipped' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20',
                                    'cancelled' => 'bg-gray-500/15 text-gray-500 border border-gray-500/20',
                                    default => 'bg-primary/15 text-primary border border-primary/20',
                                };
                            @endphp
                            <tr class="hover:bg-white/30 dark:hover:bg-white/5">
                                <td class="py-4 text-sm font-bold">{{ $order['order_number'] }}</td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-[#eadfd4] bg-white/60 text-[10px] font-bold dark:border-white/10 dark:bg-white/5">{{ $order['customer_initials'] }}</span>
                                        <span class="text-sm font-semibold">{{ $order['customer_name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-sm text-[#4e4139] dark:text-white/75">{{ $order['product_name'] }}</td>
                                <td class="py-4 text-sm text-[#4e4139] dark:text-white/75">{{ $order['date'] }}</td>
                                <td class="py-4">
                                    <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider {{ $statusClass }}">{{ str_replace('_', ' ', $order['status']) }}</span>
                                </td>
                                <td class="py-4 text-right text-sm font-bold">Rp {{ number_format($order['amount'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-sm text-[#6e5a50] dark:text-[#b89983]">No order data available yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>

        <article class="col-span-12 rounded-3xl border border-[#eadfd4] bg-white/70 p-7 shadow-sm dark:border-white/10 dark:bg-white/5 lg:col-span-3">
            <h3 class="mb-6 text-3xl font-bold tracking-tight">Latest Activity</h3>
            <div class="relative space-y-7 pl-8">
                <div class="absolute left-[12px] top-2 bottom-2 w-px bg-[#eadfd4] dark:bg-white/15"></div>

                @foreach($activities as $activity)
                    @php
                        $dotClass = match ($activity['type']) {
                            'success' => 'bg-emerald-500',
                            'warning' => 'bg-amber-500',
                            'muted' => 'bg-gray-400',
                            default => 'bg-primary',
                        };
                    @endphp
                    <div class="relative">
                        <span class="absolute -left-8 top-1.5 inline-flex h-6 w-6 items-center justify-center rounded-full border-4 border-white bg-white shadow-sm dark:border-[#1f1b18] dark:bg-[#1f1b18]">
                            <span class="h-3 w-3 rounded-full {{ $dotClass }}"></span>
                        </span>
                        <p class="text-sm font-bold leading-tight">{{ $activity['title'] }}</p>
                        <p class="mt-1 text-[13px] leading-5 text-[#6e5a50] dark:text-[#b89983]">{{ $activity['description'] }}</p>
                        <p class="mt-1 text-[10px] font-bold uppercase tracking-[0.14em] text-primary">{{ $activity['time'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>
    </section>
</x-admin.layout>
