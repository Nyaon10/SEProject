<?php

namespace App\Http\Controllers;

use App\Models\ReviewRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReviewRentalController extends Controller
{
    public function index()
    {
        $reviews = ReviewRental::with(['order', 'customer', 'product'])->get();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_Pelanggan' => 'required|exists:pelanggan,ID_Pelanggan',
            'ID_Pesanan' => 'required|exists:pesanan,ID_Pesanan',
            'ID_Barang' => 'required|exists:barang,ID_Barang',
            'Rating' => 'required|integer|min:1|max:5',
            'Review' => 'nullable|string',
            'Kondisi_Pengembalian' => 'nullable|string',
            'Tanggal_Review' => 'required|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Review);
        $prefix = 'RR' . $tanggal->format('Y') . $tanggal->format('m');

        $latest = ReviewRental::where('ID_Review', 'like', $prefix . '%')
            ->orderBy('ID_Review', 'desc')
            ->first();

        if ($latest) {
            $lastNumber = (int)substr($latest->ID_Review, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $id_review = $prefix . $newNumber;

        $data = $request->all();
        $data['ID_Review'] = $id_review;

        $review = ReviewRental::create($data);

        return response()->json($review, 201);
    }

    public function show($id)
    {
        $review = ReviewRental::with(['order', 'customer', 'product'])->findOrFail($id);
        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        $review = ReviewRental::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Rating' => 'sometimes|integer|min:1|max:5',
            'Review' => 'nullable|string',
            'Kondisi_Pengembalian' => 'nullable|string',
            'Tanggal_Review' => 'sometimes|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review->update($request->all());
        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = ReviewRental::findOrFail($id);
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully.']);
    }
}
