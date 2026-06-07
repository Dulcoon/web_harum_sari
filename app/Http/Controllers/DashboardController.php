<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
        $hasProducts = Schema::hasTable('products');
        $hasCategories = Schema::hasTable('kategoris');
        $hasUserRole = $hasUsers && Schema::hasColumn('users', 'role');
        $hasWishlists = Schema::hasTable('wishlists');

        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $previousMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $previousMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();

        // ── Summary Cards ──

        $totalProducts = $hasProducts ? (int) Product::count() : 0;
        $productsThisMonth = $hasProducts ? (int) Product::whereBetween('created_at', [$monthStart, $now])->count() : 0;
        $productsLastMonth = $hasProducts ? (int) Product::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count() : 0;

        $totalCustomers = 0;
        $customersThisMonth = 0;
        $customersLastMonth = 0;
        if ($hasUsers && $hasUserRole) {
            $totalCustomers = (int) User::where('role', 'customer')->count();
            $customersThisMonth = (int) User::where('role', 'customer')->whereBetween('created_at', [$monthStart, $now])->count();
            $customersLastMonth = (int) User::where('role', 'customer')->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        } elseif ($hasUsers) {
            $totalCustomers = (int) User::count();
            $customersThisMonth = (int) User::whereBetween('created_at', [$monthStart, $now])->count();
            $customersLastMonth = (int) User::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        }

        $activeProducts = $hasProducts ? (int) Product::where('featured_products', true)->count() : 0;
        $activeThisMonth = $hasProducts ? (int) Product::where('featured_products', true)->whereBetween('created_at', [$monthStart, $now])->count() : 0;
        $activeLastMonth = $hasProducts ? (int) Product::where('featured_products', true)->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count() : 0;

        $totalCategories = $hasCategories ? (int) Kategori::count() : 0;
        $categoriesThisMonth = $hasCategories ? (int) Kategori::whereBetween('created_at', [$monthStart, $now])->count() : 0;
        $categoriesLastMonth = $hasCategories ? (int) Kategori::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count() : 0;

        $summaryCards = [
            [
                'label' => 'Total Products',
                'value' => number_format($totalProducts),
                'trend' => $this->growthRate($productsThisMonth, $productsLastMonth),
                'icon' => 'inventory_2',
            ],
            [
                'label' => 'Total Customers',
                'value' => number_format($totalCustomers),
                'trend' => $this->growthRate($customersThisMonth, $customersLastMonth),
                'icon' => 'person',
            ],
            [
                'label' => 'Active Products',
                'value' => number_format($activeProducts),
                'trend' => $this->growthRate($activeThisMonth, $activeLastMonth),
                'icon' => 'check_circle',
            ],
            [
                'label' => 'Categories',
                'value' => number_format($totalCategories),
                'trend' => $this->growthRate($categoriesThisMonth, $categoriesLastMonth),
                'icon' => 'category',
            ],
        ];

        // ── Chart: Products per Category ──

        $chartLabels = [];
        $chartValues = [];
        $maxChartValue = 1;
        $peakIndex = 0;

        if ($hasCategories) {
            $categories = Kategori::withCount('products')
                ->orderByDesc('products_count')
                ->get();

            foreach ($categories as $cat) {
                $chartLabels[] = $cat->nama;
                $chartValues[] = (int) $cat->products_count;
            }

            $maxChartValue = max(1, ! empty($chartValues) ? max($chartValues) : 1);
            $peakIndex = ! empty($chartValues) ? array_search(max($chartValues), $chartValues) : 0;
        }

        $chartBars = [];
        foreach ($chartLabels as $index => $label) {
            $total = (int) ($chartValues[$index] ?? 0);
            $ratio = $maxChartValue > 0 ? ($total / $maxChartValue) : 0;
            $chartBars[] = [
                'label' => $label,
                'total' => $total,
                'height' => 36 + (int) round($ratio * 170),
                'active' => $index === $peakIndex,
            ];
        }

        $linePoints = [];
        foreach ($chartBars as $index => $bar) {
            $x = count($chartBars) > 1 ? ($index / (count($chartBars) - 1)) * 100 : 50;
            $y = 92 - ((($bar['total'] ?? 0) / $maxChartValue) * 74);
            $linePoints[] = round($x, 2) . ',' . round($y, 2);
        }

        // ── Top Categories (by product count) ──

        $topCategories = collect();
        if ($hasCategories) {
            $topCategories = Kategori::withCount('products')
                ->orderByDesc('products_count')
                ->limit(3)
                ->get()
                ->map(function ($item) {
                    $thumbnail = $item->thumbnail
                        ? asset('storage/' . $item->thumbnail)
                        : asset('assets/no_image.webp');

                    return [
                        'name' => $item->nama,
                        'thumbnail' => $thumbnail,
                        'share' => (int) $item->products_count,
                    ];
                });
        }

        $totalTopQty = max(1, (int) $topCategories->sum('share'));
        $topCategories = $topCategories->map(function ($item) use ($totalTopQty) {
            $item['share'] = (int) round(($item['share'] / $totalTopQty) * 100);
            return $item;
        })->values();

        // ── Low Stock Products ──

        $lowStockProducts = collect();
        if ($hasProducts) {
            $lowStockProducts = Product::with('kategori')
                ->where('stok', '<=', 5)
                ->orderBy('stok')
                ->limit(10)
                ->get()
                ->map(function (Product $product) {
                    return [
                        'id' => $product->id,
                        'nama' => $product->nama,
                        'kategori' => $product->kategori?->nama ?? 'Uncategorized',
                        'stok' => (int) $product->stok,
                        'status' => $product->featured_products ? 'Active' : 'Draft',
                        'foto' => $product->foto
                            ? asset('storage/' . ltrim($product->foto, '/'))
                            : asset('assets/no_image.webp'),
                    ];
                });
        }

        // ── Recent Activity ──

        $activities = collect();

        $latestProduct = $hasProducts ? Product::latest()->first() : null;
        if ($latestProduct) {
            $activities->push([
                'type' => 'primary',
                'title' => 'New product added',
                'description' => '"' . $latestProduct->nama . '" was added to catalog.',
                'time' => $latestProduct->created_at?->diffForHumans() ?? 'recently',
            ]);
        }

        $latestUser = $hasUsers ? User::latest()->first() : null;
        if ($latestUser) {
            $activities->push([
                'type' => 'primary',
                'title' => 'New customer registered',
                'description' => $latestUser->name . ' joined the platform.',
                'time' => $latestUser->created_at?->diffForHumans() ?? 'recently',
            ]);
        }

        $lowStockAlert = $hasProducts
            ? Product::where('stok', '<=', 5)->orderBy('stok')->first()
            : null;
        if ($lowStockAlert) {
            $activities->push([
                'type' => 'warning',
                'title' => 'Inventory alert',
                'description' => $lowStockAlert->nama . ' is running low (' . $lowStockAlert->stok . ' left).',
                'time' => $lowStockAlert->updated_at?->diffForHumans() ?? 'recently',
            ]);
        }

        if ($activities->isEmpty()) {
            $activities = collect([
                [
                    'type' => 'primary',
                    'title' => 'Dashboard ready',
                    'description' => 'Start adding products and categories to see live activity.',
                    'time' => 'just now',
                ],
            ]);
        }

        return view('dashboard', [
            'summaryCards' => $summaryCards,
            'catalogChart' => [
                'bars' => $chartBars,
                'linePoints' => implode(' ', $linePoints),
            ],
            'topCategories' => $topCategories,
            'lowStockProducts' => $lowStockProducts,
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
}
