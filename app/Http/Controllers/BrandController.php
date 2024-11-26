<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index() {
        $brand = Brand::all();

        return response()->json(['categories' => $brand]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        Brand::create($validatedData);
        return response()->json(['message' => 'Brand berhasil ditambahkan']);
    }

    public function show ($id) {
        $brand = Brand::find($id);

        if ($brand) {
            return response()->json(['brand' => $brand]);
        } else {
            return response()->json(['message' => 'Brand tidak ditemukan']);
        }
    }

    public function update (Request $request, $id) {
        $validateData = $request->validate([
            'name' => 'required',
        ]);
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json(['message' => 'Brand tidak ditemukan'], 404);
        }
        $brand->update($validateData);
        return response()->json(['message' => 'Brand berhasil diupdate']);
    }

    public function destroy ($id) {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json(['message' => 'Brand tidak ditemukan'], 404);
        }
        $brand->delete();
        return response()->json(['message' => 'Brand berhasil dihapus']);
    }
}