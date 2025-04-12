<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewSold;
use Illuminate\Support\Carbon;

class ReviewSoldController extends Controller
{
    public function index()
    {
        return ReviewSold::with(['order', 'customer', 'product'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_Pelanggan' => 'required|exists:pelanggan,ID_Pelanggan',
            'ID_Pesanan' => 'required|exists:pesanan,ID_Pesanan',
            'ID_Barang' => 'required|exists:barang,ID_Barang',
            'Rating' => 'required|integer|min:1|max:5',
            'Review' => 'nullable|string',
            'Tanggal_Review' => 'required|date_format:d-m-Y',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Review);
        $prefix = 'RS' . $tanggal->format('Ym');

        $lastReview = ReviewSold::where('ID_Review', 'like', "$prefix%")
            ->orderByDesc('ID_Review')
            ->first();

        $sequence = $lastReview ? intval(substr($lastReview->ID_Review, -4)) + 1 : 1;
        $newId = $prefix . str_pad($sequence, 4, '0', STR_PAD_LEFT);

        $review = ReviewSold::create([
            'ID_Review' => $newId,
            'ID_Pelanggan' => $request->ID_Pelanggan,
            'ID_Pesanan' => $request->ID_Pesanan,
            'ID_Barang' => $request->ID_Barang,
            'Rating' => $request->Rating,
            'Review' => $request->Review,
            'Tanggal_Review' => $request->Tanggal_Review,
        ]);

        return response()->json($review, 201);
    }

    public function show($id)
    {
        return ReviewSold::with(['order', 'customer', 'product'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $review = ReviewSold::findOrFail($id);

        $request->validate([
            'Rating' => 'sometimes|required|integer|min:1|max:5',
            'Review' => 'nullable|string',
            'Tanggal_Review' => 'sometimes|required|date_format:d-m-Y',
        ]);

        $review->update($request->only('Rating', 'Review', 'Tanggal_Review'));

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = ReviewSold::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.']);
    }
}
