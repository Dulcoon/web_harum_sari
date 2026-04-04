<?php

namespace App\Livewire\Admin;

use App\Models\Kategori;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $status = 'all';

    #[Url(as: 'kategori_id')]
    public string $kategoriId = '';

    public function mount(): void
    {
        $this->normalizeStatus();
        $this->kategoriId = (string) $this->kategoriId;
    }

    public function applyFilters(): void
    {
        $this->normalizeStatus();
        $this->resetPage();
    }

    private function normalizeStatus(): void
    {
        $allowedStatuses = ['all', 'active', 'draft', 'out_of_stock'];
        if (! in_array($this->status, $allowedStatuses, true)) {
            $this->status = 'all';
        }
    }

    public function render()
    {
        $kategories = Kategori::query()->orderBy('nama')->get();

        $products = Product::query()
            ->with('kategori')
            ->when($this->search !== '', function ($query) {
                $query->where('nama', 'like', '%' . trim($this->search) . '%');
            })
            ->when($this->kategoriId !== '', function ($query) {
                $query->where('kategori_id', $this->kategoriId);
            })
            ->when($this->status !== 'all', function ($query) {
                if ($this->status === 'active') {
                    $query->where('featured_products', true);
                } elseif ($this->status === 'draft') {
                    $query->where('featured_products', false);
                } elseif ($this->status === 'out_of_stock') {
                    $query->where('stok', '<=', 0);
                }
            })
            ->latest()
            ->paginate(10)
            ->onEachSide(1);

        $defaultThumb = asset('assets/no_image.png');
        $stockMax = max(1, (int) $products->getCollection()->max('stok'));
        $productPayload = $products->getCollection()->map(function (Product $product) use ($defaultThumb) {
            return [
                'id' => $product->id,
                'nama' => $product->nama,
                'harga' => (float) $product->harga,
                'deskripsi' => (string) $product->deskripsi,
                'kategori_id' => (string) $product->kategori_id,
                'featured_products' => (int) $product->featured_products,
                'stok' => (int) $product->stok,
                'foto' => $this->resolveProductImageUrl($product, $defaultThumb),
            ];
        })->values();

        return view('livewire.admin.product-management', [
            'kategories' => $kategories,
            'products' => $products,
            'defaultThumb' => $defaultThumb,
            'stockMax' => $stockMax,
            'productPayload' => $productPayload,
        ]);
    }

    private function resolveProductImageUrl(Product $product, string $defaultThumb): string
    {
        if (! $product->foto) {
            return $defaultThumb;
        }

        if (str_starts_with($product->foto, 'http://') || str_starts_with($product->foto, 'https://')) {
            return $product->foto;
        }

        return asset('storage/' . ltrim($product->foto, '/'));
    }
}
