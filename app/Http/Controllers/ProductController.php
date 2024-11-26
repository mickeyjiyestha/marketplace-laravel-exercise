<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword'); 
        $categoryId = $request->input('category_id');
        $brandId = $request->input('brand_id');
        $categoryName = $request->input('category_name');
        $brandName = $request->input('brand_name');
        $perPage = $request->input('per_page', 10); 
        $sortBy = $request->input('sort_by', 'name'); 
        $sortOrder = $request->input('sort_order', 'asc'); 
    
        $query = Product::query(); 
    
        if ($categoryName) {
            $query->whereHas('category', function (Builder $query) use ($categoryName) {
                $query->where('name', 'like', "%$categoryName%");
            });
        }

        if ($brandName) {
            $query->whereHas('brand', function (Builder $query) use ($brandName) {
                $query->where('name', 'like', "%$brandName%");
            });
        }
    
        if ($keyword) {
            $query->where('name', 'like', "%$keyword%");
        }
    

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }
    

        $allowedSortColumns = ['name', 'price', 'stock', 'created_at'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            return response()->json(['error' => 'Kolom sort_by tidak valid'], 400);
        }
    
        // Lakukan sorting dan paginasi
        $products = $query->with('category')  // Pastikan relasi dimuat di sini
                         ->orderBy($sortBy, $sortOrder)
                         ->paginate($perPage);
    
        // Return data dalam format JSON
        return response()->json($products);
    }
    


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'category_id.required' => 'Kategori wajib diisi.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'brand_id.required' => 'Merek wajib diisi.',
            'brand_id.exists' => 'Merek tidak ditemukan.',
        ]);

        Product::create($validatedData);

        return response()->json(['message' => 'Produk berhasil ditambahkan']);
    }

    public function show($id)
    {
        $product = Product::with(['category:name,id', 'brand:name,id'])->find($id);

        if ($product) {
            return response()->json(['product' => $product]);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->update($validatedData);

        return response()->json(['message' => 'Produk berhasil diupdate', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}