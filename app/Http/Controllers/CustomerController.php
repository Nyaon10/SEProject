<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'Nama_Pelanggan' => 'required|string|max:255',
            'NIK_Pelanggan' => 'required|numeric',
            'Alamat_Pelanggan' => 'required|string',
            'Email_Pelanggan' => 'required|email|unique:pelanggan,Email_Pelanggan',
            'Password_Pelanggan' => 'required|string|min:6',
            'No_Hp_Pelanggan' => ['required', 'regex:/^\+\d{7,15}$/'],
        ], [
            'No_Hp_Pelanggan.regex' => 'The phone number must start with + followed by the country code and digits.',
        ]);

        // Generate unique ID_Pelanggan
        $prefix = strtoupper(substr(preg_replace('/\s+/', '', $request->Nama_Pelanggan), 0, 3)); // first 3 letters, no spaces
        $latest = Customer::where('ID_Pelanggan', 'like', $prefix . '%')
                    ->orderBy('ID_Pelanggan', 'desc')
                    ->first();

        if ($latest) {
            $lastNumber = (int) substr($latest->ID_Pelanggan, 3);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $newID = $prefix . $newNumber;

        // Create the customer
        $customer = Customer::create([
            'ID_Pelanggan' => $newID,
            'Nama_Pelanggan' => $request->Nama_Pelanggan,
            'NIK_Pelanggan' => $request->NIK_Pelanggan,
            'Alamat_Pelanggan' => $request->Alamat_Pelanggan,
            'Email_Pelanggan' => $request->Email_Pelanggan,
            'Password_Pelanggan' => $request->Password_Pelanggan, // model mutator will hash it
            'No_Hp_Pelanggan' => $request->No_Hp_Pelanggan,
            'Akun_Instagram' => $request->Akun_Instagram ?? null,
            'Blacklist_status' => false,
            'Status_Pelanggan' => 'Aktif',
        ]);

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }
}
