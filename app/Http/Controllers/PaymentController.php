<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with('order')->get();
    }

    public function show($id)
    {
        return Payment::with('order')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_Pesanan' => 'required|exists:pesanan,ID_Pesanan',
            'Tanggal_Pembayaran' => 'required|date_format:d-m-Y',
            'Jumlah_Bayaran_Terima' => 'required|numeric',
            'Total_Tagihan' => 'required|numeric',
            'Status_Pembayaran' => 'required|string',
            'Metode_Pembayaran' => 'required|string',
            'Bukti_Pembayaran' => 'nullable|array',
            'Tipe_Transasksi' => 'required|string',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Pembayaran);
        $prefix = 'P' . $tanggal->format('Ym');
        $latestPayment = Payment::where('ID_Pembayaran', 'like', $prefix . '%')
            ->orderBy('ID_Pembayaran', 'desc')
            ->first();

        if ($latestPayment) {
            $lastIncrement = (int) substr($latestPayment->ID_Pembayaran, -4);
            $newIncrement = str_pad($lastIncrement + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newIncrement = '0001';
        }

        $idPembayaran = $prefix . $newIncrement;

        $payment = Payment::create([
            'ID_Pembayaran' => $idPembayaran,
            'ID_Pesanan' => $request->ID_Pesanan,
            'Tanggal_Pembayaran' => $request->Tanggal_Pembayaran,
            'Jumlah_Bayaran_Terima' => $request->Jumlah_Bayaran_Terima,
            'Total_Tagihan' => $request->Total_Tagihan,
            'Status_Pembayaran' => $request->Status_Pembayaran,
            'Metode_Pembayaran' => $request->Metode_Pembayaran,
            'Bukti_Pembayaran' => $request->Bukti_Pembayaran,
            'Tipe_Transasksi' => $request->Tipe_Transasksi,
        ]);

        return response()->json($payment, 201);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'Jumlah_Bayaran_Terima' => 'sometimes|numeric',
            'Total_Tagihan' => 'sometimes|numeric',
            'Status_Pembayaran' => 'sometimes|string',
            'Metode_Pembayaran' => 'sometimes|string',
            'Bukti_Pembayaran' => 'nullable|array',
            'Tipe_Transasksi' => 'sometimes|string',
        ]);

        $payment->update($request->all());

        return response()->json($payment);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
