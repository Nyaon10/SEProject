<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        return OrderDetail::with(['order', 'product'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_Pesanan' => 'required|exists:pesanan,ID_Pesanan',
            'ID_Barang' => 'required|exists:barang,ID_Barang',
            'Jumlah_Barang' => 'required|integer|min:1',
            'Harga_Satuan' => 'required|numeric|min:0',
        ]);

        $validated['Subtotal'] = $validated['Jumlah_Barang'] * $validated['Harga_Satuan'];

        $orderDetail = OrderDetail::create($validated);

        $this->updateOrderTotal($validated['ID_Pesanan']);

        return response()->json($orderDetail, 201);
    }

    public function show($id)
    {
        return OrderDetail::with(['order', 'product'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $orderDetail = OrderDetail::findOrFail($id);

        $validated = $request->validate([
            'Jumlah_Barang' => 'required|integer|min:1',
            'Harga_Satuan' => 'required|numeric|min:0',
        ]);

        $validated['Subtotal'] = $validated['Jumlah_Barang'] * $validated['Harga_Satuan'];

        $orderDetail->update($validated);

        $this->updateOrderTotal($orderDetail->ID_Pesanan);

        return response()->json($orderDetail);
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderId = $orderDetail->ID_Pesanan;
        $orderDetail->delete();

        $this->updateOrderTotal($orderId);

        return response()->json(['message' => 'Order detail deleted successfully.']);
    }

    protected function updateOrderTotal($orderId)
    {
        $total = OrderDetail::where('ID_Pesanan', $orderId)->sum('Subtotal');
        Order::where('ID_Pesanan', $orderId)->update(['Total_Harga' => $total]);
    }
}
