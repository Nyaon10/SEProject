<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'Nama_Barang' => 'required|string|max:255',
            'Deskripsi_Barang' => 'required|string',
            'Gambar_Barang' => 'required|array',
            'ID_Kategori' => 'required|exists:kategori,ID_Kategori',
            'Jumlah_Barang' => 'required|integer|min:0',
            'Harga_Barang' => 'required|numeric|min:0',
            'Tanggal_Stok_Barang' => 'required|date_format:d-m-Y',
            'Keterangan' => 'nullable|string',
            'Status_Barang' => 'required|in:tersedia,tidak tersedia'
        ]);

        $id = Str::uuid()->toString(); // or customize based on your preferred logic

        $product = Product::create([
            'ID_Barang' => $id,
            'Nama_Barang' => $request->Nama_Barang,
            'Deskripsi_Barang' => $request->Deskripsi_Barang,
            'Gambar_Barang' => $request->Gambar_Barang,
            'ID_Kategori' => $request->ID_Kategori,
            'Jumlah_Barang' => $request->Jumlah_Barang,
            'Harga_Barang' => $request->Harga_Barang,
            'Tanggal_Stok_Barang' => $request->Tanggal_Stok_Barang,
            'Keterangan' => $request->Keterangan,
            'Status_Barang' => $request->Status_Barang
        ]);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan.',
            'data' => $product
        ], 201);
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
        }

        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
        }

        $request->validate([
            'Nama_Barang' => 'sometimes|string|max:255',
            'Deskripsi_Barang' => 'nullable|string',
            'Gambar_Barang' => 'nullable|array',
            'ID_Kategori' => 'sometimes|exists:kategori,ID_Kategori',
            'Jumlah_Barang' => 'sometimes|integer|min:0',
            'Harga_Barang' => 'sometimes|numeric|min:0',
            'Tanggal_Stok_Barang' => 'sometimes|date_format:d-m-Y',
            'Keterangan' => 'nullable|string',
            'Status_Barang' => 'sometimes|in:tersedia,tidak tersedia'
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Barang berhasil diperbarui.',
            'data' => $product
        ]);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Barang berhasil dihapus.']);
    }
}
