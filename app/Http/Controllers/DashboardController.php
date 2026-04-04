<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();
        if (! $user || (($user->role ?? 'customer') !== 'admin')) {
            return redirect()->route('homepage.home');
        }

        $hasUsers = Schema::hasTable('users');
        $hasOrders = Schema::hasTable('orders');
        $hasTransactions = Schema::hasTable('transactions');
        $hasProducts = Schema::hasTable('products');
        $hasCategories = Schema::hasTable('kategoris');
        $hasOrderItems = Schema::hasTable('order_items');
        $hasUserRole = $hasUsers && Schema::hasColumn('users', 'role');

        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $previousMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $previousMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();

        $paidOrderStatuses = ['paid', 'shipped', 'completed'];

        $totalSales = 0.0;
        $salesCurrentMonth = 0.0;
        $salesPreviousMonth = 0.0;

        if ($hasOrders) {
            $salesQuery = Order::query()->whereIn('status', $paidOrderStatuses);
            $totalSales = (float) $salesQuery->sum('total_amount');
            $salesCurrentMonth = (float) (clone $salesQuery)->whereBetween('created_at', [$monthStart, $now])->sum('total_amount');
            $salesPreviousMonth = (float) (clone $salesQuery)->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->sum('total_amount');
        } elseif ($hasTransactions) {
            $salesQuery = Transaction::query()->where('payment_status', 'completed');
            $totalSales = (float) $salesQuery->sum('gross_amount');
            $salesCurrentMonth = (float) (clone $salesQuery)->whereBetween('created_at', [$monthStart, $now])->sum('gross_amount');
            $salesPreviousMonth = (float) (clone $salesQuery)->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->sum('gross_amount');
        }

        $visitorsQuery = User::query();
        if ($hasUserRole) {
            $visitorsQuery->where('role', 'customer');
        }
        $totalVisitors = $hasUsers ? (int) (clone $visitorsQuery)->count() : 0;
        $visitorsCurrentMonth = $hasUsers ? (int) (clone $visitorsQuery)->whereBetween('created_at', [$monthStart, $now])->count() : 0;
        $visitorsPreviousMonth = $hasUsers ? (int) (clone $visitorsQuery)->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count() : 0;

        $totalOrders = $hasOrders ? (int) Order::query()->count() : 0;
        $ordersCurrentMonth = $hasOrders ? (int) Order::query()->whereBetween('created_at', [$monthStart, $now])->count() : 0;
        $ordersPreviousMonth = $hasOrders ? (int) Order::query()->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count() : 0;

        $activeCustomers = 0;
        $activeCustomersCurrentMonth = 0;
        $activeCustomersPreviousMonth = 0;
        if ($hasOrders) {
            $activeCustomers = (int) Order::query()->distinct('user_id')->count('user_id');
            $activeCustomersCurrentMonth = (int) Order::query()
                ->whereBetween('created_at', [$monthStart, $now])
                ->distinct('user_id')
                ->count('user_id');
            $activeCustomersPreviousMonth = (int) Order::query()
                ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
                ->distinct('user_id')
                ->count('user_id');
        } elseif ($hasTransactions) {
            $activeCustomers = (int) Transaction::query()->distinct('user_id')->count('user_id');
            $activeCustomersCurrentMonth = (int) Transaction::query()
                ->whereBetween('created_at', [$monthStart, $now])
                ->distinct('user_id')
                ->count('user_id');
            $activeCustomersPreviousMonth = (int) Transaction::query()
                ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
                ->distinct('user_id')
                ->count('user_id');
        }

        $summaryCards = [
            [
                'label' => 'Total Sales',
                'value' => $this->currency($totalSales),
                'trend' => $this->growthRate($salesCurrentMonth, $salesPreviousMonth),
                'icon' => 'payments',
            ],
            [
                'label' => 'Website Visitors',
                'value' => number_format($totalVisitors),
                'trend' => $this->growthRate($visitorsCurrentMonth, $visitorsPreviousMonth),
                'icon' => 'visibility',
            ],
            [
                'label' => 'Total Orders',
                'value' => number_format($totalOrders),
                'trend' => $this->growthRate($ordersCurrentMonth, $ordersPreviousMonth),
                'icon' => 'inventory_2',
            ],
            [
                'label' => 'Active Customers',
                'value' => number_format($activeCustomers),
                'trend' => $this->growthRate($activeCustomersCurrentMonth, $activeCustomersPreviousMonth),
                'icon' => 'person_add',
            ],
        ];

        $chartDays = collect(range(6, 0))->map(function (int $offset): Carbon {
            return now()->subDays($offset)->startOfDay();
        });
        $chartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        $weeklyTotalsRaw = [];
        if ($hasOrders) {
            $weeklyTotalsRaw = Order::query()
                ->selectRaw('DATE(created_at) as day, SUM(total_amount) as total')
                ->whereIn('status', $paidOrderStatuses)
                ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
                ->groupBy('day')
                ->pluck('total', 'day')
                ->toArray();
        } elseif ($hasTransactions) {
            $weeklyTotalsRaw = Transaction::query()
                ->selectRaw('DATE(created_at) as day, SUM(gross_amount) as total')
                ->where('payment_status', 'completed')
                ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
                ->groupBy('day')
                ->pluck('total', 'day')
                ->toArray();
        }

        $chartBars = [];
        foreach ($chartDays as $index => $day) {
            $key = $day->toDateString();
            $total = (float) ($weeklyTotalsRaw[$key] ?? 0);
            $chartBars[] = [
                'label' => $chartLabels[$index] ?? $day->format('D'),
                'total' => $total,
            ];
        }

        $maxChartValue = max(1, (float) collect($chartBars)->max('total'));
        $peakIndex = (int) collect($chartBars)->search(collect($chartBars)->sortByDesc('total')->first());

        $linePoints = [];
        foreach ($chartBars as $index => &$bar) {
            $ratio = $maxChartValue > 0 ? ($bar['total'] / $maxChartValue) : 0;
            $bar['height'] = 36 + (int) round($ratio * 170);
            $bar['active'] = $index === $peakIndex;

            $x = count($chartBars) > 1 ? ($index / (count($chartBars) - 1)) * 100 : 50;
            $y = 92 - ($ratio * 74);
            $linePoints[] = round($x, 2).','.round($y, 2);
        }
        unset($bar);

        $topCategories = collect();
        if ($hasOrderItems && $hasProducts && $hasCategories) {
            $topCategories = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('kategoris', 'products.kategori_id', '=', 'kategoris.id')
                ->select(
                    'kategoris.id',
                    'kategoris.nama',
                    'kategoris.thumbnail',
                    DB::raw('SUM(order_items.quantity) as qty')
                )
                ->groupBy('kategoris.id', 'kategoris.nama', 'kategoris.thumbnail')
                ->orderByDesc('qty')
                ->limit(3)
                ->get();
        }

        if ($topCategories->isEmpty() && $hasCategories) {
            $topCategories = Kategori::query()
                ->withCount('products')
                ->orderByDesc('products_count')
                ->limit(3)
                ->get()
                ->map(function ($item) {
                    return (object) [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'thumbnail' => $item->thumbnail,
                        'qty' => $item->products_count,
                    ];
                });
        }

        $totalTopQty = max(1, (int) collect($topCategories)->sum('qty'));
        $topCategories = collect($topCategories)->map(function ($item) use ($totalTopQty) {
            $name = (string) ($item->nama ?? 'Category');
            $thumbnail = $item->thumbnail ? asset('storage/'.$item->thumbnail) : asset('assets/no_image.png');
            $qty = (int) ($item->qty ?? 0);
            $share = (int) round(($qty / $totalTopQty) * 100);

            return [
                'name' => $name,
                'thumbnail' => $thumbnail,
                'share' => $share,
            ];
        })->values();

        $recentOrders = collect();
        if ($hasOrders) {
            $recentOrders = Order::query()
                ->with(['orderItems.product', 'user'])
                ->latest()
                ->limit(5)
                ->get()
                ->map(function (Order $order) {
                    $customerName = $order->user->name ?? 'Guest Customer';
                    $parts = preg_split('/\s+/', trim($customerName)) ?: [];
                    $initials = strtoupper(substr((string) ($parts[0] ?? 'G'), 0, 1).substr((string) ($parts[1] ?? 'C'), 0, 1));
                    $firstItem = $order->orderItems->first();

                    return [
                        'order_number' => $order->order_number ?: '#HL-'.str_pad((string) $order->id, 4, '0', STR_PAD_LEFT),
                        'customer_name' => $customerName,
                        'customer_initials' => $initials,
                        'product_name' => $firstItem?->product?->nama ?? 'Mixed Items',
                        'date' => $order->created_at?->format('M d, Y') ?? '-',
                        'status' => $order->status ?? 'pending',
                        'amount' => (float) $order->total_amount,
                    ];
                });
        }

        $activities = collect();
        if ($hasUsers) {
            $latestUser = User::query()->latest()->first();
            if ($latestUser) {
                $activities->push([
                    'type' => 'primary',
                    'title' => 'New customer registered',
                    'description' => $latestUser->name.' joined the platform.',
                    'time' => $latestUser->created_at?->diffForHumans() ?? 'recently',
                ]);
            }
        }
        if ($hasOrders) {
            $latestOrder = Order::query()->latest()->first();
            if ($latestOrder) {
                $activities->push([
                    'type' => 'muted',
                    'title' => 'New order '.$latestOrder->order_number,
                    'description' => 'Order status is '.strtoupper((string) $latestOrder->status).'.',
                    'time' => $latestOrder->created_at?->diffForHumans() ?? 'recently',
                ]);
            }
        }
        if ($hasProducts) {
            $lowStockProduct = Product::query()->where('stok', '<=', 5)->orderBy('stok')->first();
            if ($lowStockProduct) {
                $activities->push([
                    'type' => 'warning',
                    'title' => 'Inventory alert: '.$lowStockProduct->nama,
                    'description' => 'Stock level is '.$lowStockProduct->stok.' item(s).',
                    'time' => $lowStockProduct->updated_at?->diffForHumans() ?? 'recently',
                ]);
            }
        }
        if ($hasTransactions) {
            $latestPaid = Transaction::query()->where('payment_status', 'completed')->latest()->first();
            if ($latestPaid) {
                $activities->push([
                    'type' => 'success',
                    'title' => 'Payout processed',
                    'description' => 'Payment marked completed for order '.$latestPaid->order_id.'.',
                    'time' => $latestPaid->updated_at?->diffForHumans() ?? 'recently',
                ]);
            }
        }

        if ($activities->isEmpty()) {
            $activities = collect([
                [
                    'type' => 'primary',
                    'title' => 'Dashboard ready',
                    'description' => 'Start adding products and orders to see live activity.',
                    'time' => 'just now',
                ],
            ]);
        }

        return view('dashboard', [
            'summaryCards' => $summaryCards,
            'salesChart' => [
                'bars' => $chartBars,
                'linePoints' => implode(' ', $linePoints),
            ],
            'topCategories' => $topCategories,
            'recentOrders' => $recentOrders,
            'activities' => $activities->take(5)->values(),
            'adminName' => $user->name,
        ]);
    }

    private function growthRate(float|int $current, float|int $previous): float
    {
        $current = (float) $current;
        $previous = (float) $previous;
        if ($previous <= 0.0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        return (($current - $previous) / $previous) * 100;
    }

    private function currency(float $amount): string
    {
        return 'Rp '.number_format($amount, 0, ',', '.');
    }
}
