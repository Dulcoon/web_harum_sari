<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;




class ProductController extends Controller
{
    public function index(Request $request)
    {
        $kategoriId = $request->input('kategori_id'); 
    
        $kategories = Kategori::all();
    
        $products = Product::with('kategori')
                    ->when($kategoriId, function ($query, $kategoriId) {
                        $query->where('kategori_id', $kategoriId);
                    })
                    ->paginate(10);
    
        return view('products.index', compact('products', 'kategories', 'kategoriId'));
    }

    public function create()
    {
        $kategories = Kategori::all();
        return view('products.create', compact('kategories'));
    }

    use \Illuminate\Foundation\Validation\ValidatesRequests;
    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => "required",
            "harga" => "required|numeric",
            "deskripsi" => "required",
            "kategori_id" => "required",
            "featured_products" => "required|bool",
            "foto" => "required|image|mimes:jpeg,png,jpg",
        ]);
    
        $foto = $request->file("foto");
    
        $fotoPath = $foto->storeAs('', $foto->hashName(), 'public');

        Product::create([
            "nama" => $request->nama,
            "harga" => $request->harga,
            "deskripsi" => $request->deskripsi,
            "kategori_id" => $request->kategori_id,
            "featured_products" => $request->featured_products,
            "foto" => $foto->hashName(),
        ]);
    
        return redirect()->route("products.index")->with("success", "Produk berhasil ditambahkan!");
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
    
        $kategories = Kategori::all();
    
        return view('products.edit', compact('product', 'kategories'));
    }
    public function detail($id)
    {
        $product = Product::with('kategori')->findOrFail($id);
    
    
        return view('products.detail', compact('product'));
    }


    
    
    public function update(Request $request, Product $product)
    {
        // Validasi input, foto tidak wajib jika tidak diubah
        $this->validate($request, [
            "nama" => "required",
            "harga" => "required|numeric",
            "deskripsi" => "required",
            "kategori_id" => "required",
            "featured_products" => "required|bool",
            "foto" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ]);
    
        // Update data produk
        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;
        $product->kategori_id = $request->kategori_id;
        $product->featured_products = $request->featured_products;
    
        if ($request->hasFile("foto")) {
            if ($product->foto && $product->foto !== 'no_image.png') {
                Storage::disk('public')->delete($product->foto);
            }
    
            $foto = $request->file("foto");
            $fotoPath = $foto->storeAs('products', $foto->hashName(), 'public');
            $product->foto = $fotoPath; 
        }
    
        // Simpan perubahan
        $product->save();
    
        return redirect()->route("products.index")->with("success", "Produk berhasil diupdate!");
    }
    
    
    public function destroy(Product $product)
    {
        if ($product->foto !== 'no_image.png') {
            Storage::disk('public')->delete($product->foto);

        }
        $product->delete();
        return redirect()->route("products.index")->with("success", "Produk berhasil dihapus!");
    }

    public function category($kategori_id)
    {
    $products = Product::where('kategori_id', $kategori_id)->paginate(12);

    return view('products.index', compact('products', 'kategori_id'));
    }


}
