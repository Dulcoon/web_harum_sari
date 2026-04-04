<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.index');
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('products.index', ['create' => 1]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'featured_products' => ['required', 'boolean'],
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:3072'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        $fotoPath = $request->file('foto')->store('products', 'public');

        Product::create([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'kategori_id' => $validated['kategori_id'],
            'featured_products' => (bool) $validated['featured_products'],
            'foto' => $fotoPath,
            'stok' => $validated['stok'],
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product): RedirectResponse
    {
        return redirect()->route('products.index', ['edit' => $product->id]);
    }

    public function detail($id): View
    {
        $product = Product::with('kategori')->findOrFail($id);

        return view('products.detail', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'featured_products' => ['required', 'boolean'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:3072'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        $product->nama = $validated['nama'];
        $product->harga = $validated['harga'];
        $product->deskripsi = $validated['deskripsi'];
        $product->kategori_id = $validated['kategori_id'];
        $product->featured_products = (bool) $validated['featured_products'];
        $product->stok = $validated['stok'];

        if ($request->hasFile('foto')) {
            if ($product->foto && $product->foto !== 'no_image.png' && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }

            $product->foto = $request->file('foto')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->foto && $product->foto !== 'no_image.png' && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function category($kategori_id): RedirectResponse
    {
        return redirect()->route('products.index', ['kategori_id' => $kategori_id]);
    }

}
