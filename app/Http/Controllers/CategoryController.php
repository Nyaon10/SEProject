<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'Nama_Kategori' => 'required|string|max:255|unique:kategori,Nama_Kategori',
        ]);

        $category = Category::create([
            'Nama_Kategori' => $request->Nama_Kategori,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $category
        ], 201);
    }

    // Show a specific category
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        return response()->json($category);
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        $request->validate([
            'Nama_Kategori' => 'required|string|max:255|unique:kategori,Nama_Kategori,' . $id . ',ID_Kategori',
        ]);

        $category->update([
            'Nama_Kategori' => $request->Nama_Kategori,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $category
        ]);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus.']);
    }
}
