<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::with(['customer', 'orderDetails'])->get();
        return response()->json($orders);
    }

    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'ID_Pelanggan' => 'required|exists:pelanggan,ID_Pelanggan',
            'Tanggal_Pesanan' => 'required|date_format:d-m-Y',
            'Status_Pesanan' => 'required|string',
            'Total_Harga' => 'required|numeric|min:0',
            'Metode_Pembayaran' => 'required|string',
        ]);

        // Convert Tanggal_Pesanan to Carbon date
        $tanggal = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Pesanan);
        $year = $tanggal->format('Y');
        $month = $tanggal->format('m');

        // Count existing orders in this month
        $orderCount = Order::whereYear('Tanggal_Pesanan', $year)
            ->whereMonth('Tanggal_Pesanan', $month)
            ->count() + 1;

        // Create order number with padding
        $orderNumber = str_pad($orderCount, 4, '0', STR_PAD_LEFT);
        $idPesanan = "ODR{$year}{$month}{$orderNumber}";

        // Create the order
        $order = Order::create([
            'ID_Pesanan' => $idPesanan,
            'ID_Pelanggan' => $request->ID_Pelanggan,
            'Tanggal_Pesanan' => $request->Tanggal_Pesanan,
            'Status_Pesanan' => $request->Status_Pesanan,
            'Total_Harga' => $request->Total_Harga,
            'Metode_Pembayaran' => $request->Metode_Pembayaran,
        ]);

        return response()->json([
            'message' => 'Pesanan berhasil dibuat.',
            'data' => $order
        ], 201);
    }

    // Show one order
    public function show($id)
    {
        $order = Order::with(['customer', 'orderDetails'])->findOrFail($id);
        return response()->json($order);
    }

    // Update an order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'Status_Pesanan' => 'sometimes|required|string',
            'Total_Harga' => 'sometimes|required|numeric|min:0',
            'Metode_Pembayaran' => 'sometimes|required|string',
        ]);

        $order->update($request->only([
            'Status_Pesanan',
            'Total_Harga',
            'Metode_Pembayaran'
        ]));

        return response()->json([
            'message' => 'Pesanan berhasil diperbarui.',
            'data' => $order
        ]);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus.']);
    }
}
