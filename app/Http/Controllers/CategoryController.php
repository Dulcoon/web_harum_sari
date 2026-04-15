<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;
use Illuminate\Validation\Rule;




class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = (string) $request->query('q', '');

        $categories = Kategori::query()
            ->withCount('products')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('kategori.kategori', compact('categories', 'search'));
    }

    public function create()
    {
        return redirect()->route('category.index');
    }

    use \Illuminate\Foundation\Validation\ValidatesRequests;
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255', Rule::unique('kategoris', 'nama')],
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'nama.unique' => 'Nama kategori sudah digunakan.',
            'thumbnail.max' => 'Ukuran thumbnail tidak boleh lebih dari 10MB.',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('categories', 'public');

        Kategori::create([
            'nama' => $request->nama,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $category = Kategori::findOrFail($id);

        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255', Rule::unique('kategoris', 'nama')->ignore($id)],
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'nama.unique' => 'Nama kategori sudah digunakan.',
            'thumbnail.max' => 'Ukuran thumbnail tidak boleh lebih dari 10MB.',
        ]);

        $category->nama = $request->nama;

        if ($request->hasFile('thumbnail')) {
            if ($category->thumbnail && $category->thumbnail !== 'no_image.png' && Storage::disk('public')->exists($category->thumbnail)) {
                Storage::disk('public')->delete($category->thumbnail);
            }

            $category->thumbnail = $request->file('thumbnail')->store('categories', 'public');
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
    }




    public function edit($id)
    {
        return redirect()->route('category.index');
    }

    public function detail($id)
    {
        $product = Product::with('kategori')->findOrFail($id);

        return view('products.detail', compact('product'));
    }


    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        $category->products()->delete();

        if (!empty($category->thumbnail) && $category->thumbnail !== 'no_image.png' && Storage::disk('public')->exists($category->thumbnail)) {
            Storage::disk('public')->delete($category->thumbnail);
        }

        try {
            $category->delete();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }


    public function category($kategori_id)
    {
        $products = Product::where('kategori_id', $kategori_id)->paginate(12);

        return view('products.index', compact('products', 'kategori_id'));
    }


}
