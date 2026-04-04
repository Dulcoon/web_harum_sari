<?php

namespace App\Livewire\Homepage;

use App\Models\Kategori;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    #[Url(as: 'kategori_id')]
    public $kategoriId = null;

    #[Url]
    public string $sort = 'newest';

    #[Url(as: 'max_price')]
    public $maxPrice = null;

    public int $dbMaxPrice = 5000000;

    public function mount(): void
    {
        $this->dbMaxPrice = (int) (Product::max('harga') ?? 5000000);
        $this->maxPrice = $this->normalizeMaxPrice($this->maxPrice ?? $this->dbMaxPrice);
    }

    public function updatedKategoriId(): void
    {
        $this->resetPage();
        $this->dispatch('mobile-filter-applied');
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    public function updatedMaxPrice($value): void
    {
        $this->maxPrice = $this->normalizeMaxPrice((int) $value);
        $this->resetPage();
    }

    private function normalizeMaxPrice(int $value): int
    {
        if ($value < 0) {
            return 0;
        }

        if ($value > $this->dbMaxPrice) {
            return $this->dbMaxPrice;
        }

        return $value;
    }

    public function render()
    {
        $kategories = Kategori::withCount('products')->get();

        $query = Product::with('kategori')
            ->where('harga', '<=', (int) $this->maxPrice);

        if (!is_null($this->kategoriId)) {
            $query->where('kategori_id', $this->kategoriId);
        }

        switch ($this->sort) {
            case 'price_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(10);

        return view('livewire.homepage.product-listing', [
            'kategories' => $kategories,
            'products' => $products,
        ]);
    }
}
