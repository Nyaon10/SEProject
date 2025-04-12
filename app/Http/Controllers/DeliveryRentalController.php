<?php

namespace App\Http\Controllers;

use App\Models\DeliveryRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeliveryRentalController extends Controller
{
    public function index()
    {
        $deliveries = DeliveryRental::with('order')->get();
        return response()->json($deliveries);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_Pesanan' => 'required|exists:pesanan,ID_Pesanan',
            'Nama_Penerima' => 'required|string',
            'No_Hp_Penerima' => 'required|string|starts_with:+',
            'Alamat_Pengiriman' => 'required|string',
            'Kurir' => 'required|string',
            'Tipe_Kurir' => 'required|string',
            'Resi' => 'nullable|string',
            'Status_Pengiriman' => 'required|string',
            'Tanggal_Kirim' => 'required|date_format:d-m-Y',
            'Tanggal_Terima' => 'nullable|date_format:d-m-Y',
            'Tanggal_Pengembalian' => 'nullable|date_format:d-m-Y',
            'Status_Pengembalian' => 'nullable|string',
            'Tanggal_Dikembalikan' => 'nullable|date_format:d-m-Y',
            'Jumlah_Hari_Overdue' => 'nullable|integer',
        ]);

        $tanggalKirim = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Kirim);
        $prefix = 'DR' . $tanggalKirim->format('Ym');

        $lastID = DeliveryRental::where('ID_Pengiriman', 'like', $prefix . '%')
            ->orderBy('ID_Pengiriman', 'desc')
            ->value('ID_Pengiriman');

        $newNumber = $lastID ? intval(substr($lastID, -4)) + 1 : 1;
        $newID = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $delivery = DeliveryRental::create(array_merge(
            $request->all(),
            ['ID_Pengiriman' => $newID]
        ));

        return response()->json(['message' => 'Delivery rental created successfully', 'data' => $delivery], 201);
    }

    public function show($id)
    {
        $delivery = DeliveryRental::with('order')->findOrFail($id);
        return response()->json($delivery);
    }

    public function update(Request $request, $id)
    {
        $delivery = DeliveryRental::findOrFail($id);
        $delivery->update($request->all());
        return response()->json(['message' => 'Delivery rental updated successfully', 'data' => $delivery]);
    }

    public function destroy($id)
    {
        $delivery = DeliveryRental::findOrFail($id);
        $delivery->delete();
        return response()->json(['message' => 'Delivery rental deleted successfully']);
    }
}
