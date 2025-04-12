<?php

namespace App\Http\Controllers;

use App\Models\DeliverySold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeliverySoldController extends Controller
{
    public function index()
    {
        $deliveries = DeliverySold::all();
        return response()->json($deliveries);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_Pesanan' => 'required|exists:pesanan,ID_Pesanan',
            'Nama_Penerima' => 'required|string',
            'No_Hp_Penerima' => 'required|string',
            'Alamat_Pengiriman' => 'required|string',
            'Kurir' => 'required|string',
            'Tipe_Kurir' => 'required|string',
            'Resi' => 'nullable|string',
            'Status_Pengiriman' => 'required|string',
            'Tanggal_Kirim' => 'required|date_format:d-m-Y',
            'Tanggal_Terima' => 'nullable|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tanggalKirim = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Kirim);
        $prefix = 'DS' . $tanggalKirim->format('Ym');

        $latest = DeliverySold::where('ID_Pengiriman', 'like', $prefix . '%')
            ->orderBy('ID_Pengiriman', 'desc')
            ->first();

        if ($latest) {
            $lastNumber = (int)substr($latest->ID_Pengiriman, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $newID = $prefix . $newNumber;

        $delivery = DeliverySold::create(array_merge(
            $request->all(),
            ['ID_Pengiriman' => $newID]
        ));

        return response()->json($delivery, 201);
    }

    public function show($id)
    {
        $delivery = DeliverySold::findOrFail($id);
        return response()->json($delivery);
    }

    public function update(Request $request, $id)
    {
        $delivery = DeliverySold::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Nama_Penerima' => 'sometimes|required|string',
            'No_Hp_Penerima' => 'sometimes|required|string',
            'Alamat_Pengiriman' => 'sometimes|required|string',
            'Kurir' => 'sometimes|required|string',
            'Tipe_Kurir' => 'sometimes|required|string',
            'Resi' => 'nullable|string',
            'Status_Pengiriman' => 'sometimes|required|string',
            'Tanggal_Kirim' => 'nullable|date_format:d-m-Y',
            'Tanggal_Terima' => 'nullable|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $delivery->update($request->all());

        return response()->json($delivery);
    }

    public function destroy($id)
    {
        $delivery = DeliverySold::findOrFail($id);
        $delivery->delete();

        return response()->json(['message' => 'Delivery deleted successfully.']);
    }
}
