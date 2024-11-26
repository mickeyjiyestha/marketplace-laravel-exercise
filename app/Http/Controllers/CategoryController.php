<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $category = Category::all();

        return response()->json(['categories' =>$category]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        Category::create($validatedData);
        return response()->json(['message' => 'Kategori berhasil ditambahkan']);
    }

    public function show($id) {
        $category = Category::find($id);

        if ($category) {
            return response()->json(['category' => $category]);
        } else {
            return response()->json(['message' => 'Kategori tidak ditemukan']);
        }
    }

    public function update (Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
        $category->update($validatedData);
        return response()->json(['message' => 'Kategori berhasil diupdate']);   
    }

    public function destroy($id) {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}