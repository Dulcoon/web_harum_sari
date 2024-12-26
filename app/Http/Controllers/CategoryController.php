<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;




class CategoryController extends Controller
{
    public function index(Request $request)
    {
    
        $categories = Kategori::all();
    
    
        return view('kategori.kategori', compact( 'categories',));
    }

    public function create()
    {
        // $kategories = Kategori::all();
        return view('kategori.createKategori');
    }

    use \Illuminate\Foundation\Validation\ValidatesRequests;
    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => "required",
            "thumbnail" => "required|image|mimes:jpeg,png,jpg",
        ]);
    
        $thumbnail = $request->file("thumbnail");
    
        $fotoPath = $thumbnail->storeAs('', $thumbnail->hashName(), 'public');

        Kategori::create([
            "nama" => $request->nama,
            "thumbnail" => $thumbnail->hashName(),
        ]);
    
        return redirect()->route("category.index")->with("success", "Produk berhasil ditambahkan!");
    }
    

    public function update(Request $request, $id)
{
    // Validasi input
    $this->validate($request, [
        "nama" => "required|string|max:255",
        "thumbnail" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
    ]);

    // Temukan kategori berdasarkan ID
    $category = Kategori::findOrFail($id);

    // Update nama kategori hanya jika ada perubahan
    if ($request->nama !== $category->nama) {
        $category->nama = $request->nama;
    }

    // Periksa apakah ada file thumbnail yang diunggah
    if ($request->hasFile('thumbnail')) {
        // Hapus thumbnail lama jika ada dan bukan default 'no_image.png'
        if ($category->thumbnail && $category->thumbnail !== 'no_image.png') {
            Storage::disk('public')->delete($category->thumbnail);
        }

        // Simpan thumbnail baru
        $thumbnail = $request->file('thumbnail');
        $thumbnailPath = $thumbnail->storeAs('categories', $thumbnail->hashName(), 'public');
        $category->thumbnail = $thumbnailPath;
    }

    // Simpan perubahan
    $category->save();

    // Kembalikan ke halaman daftar kategori dengan pesan sukses
    return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
}




    public function edit($id)
    {
        $categories = Kategori::findOrFail($id);
    
        return view('kategori.editKategori', compact('categories'));
    }
    
    public function detail($id)
    {
        $product = Product::with('kategori')->findOrFail($id);
    
        return view('products.detail', compact('product'));
    }
    
    
    public function destroy(kategori $categories)
    {
        $categories->products()->delete(); // Jika relasi ada di model kategori
    
        if (!empty($categories->thumbnail) && $categories->thumbnail !== 'no_image.png') {
            Storage::disk('public')->delete($categories->thumbnail);
        }
    
        // Hapus kategori
        try {
            $categories->delete();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return redirect()->route("category.index")->with("success", "kategori berhasil dihapus!");

        // Redirect dengan pesan sukses
    }
    

    public function category($kategori_id)
    {
    $products = Product::where('kategori_id', $kategori_id)->paginate(12);

    return view('products.index', compact('products', 'kategori_id'));
    }


}
