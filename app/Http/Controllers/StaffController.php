<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'Nama_Staff' => 'required|string|max:255',
            'NIK_Staff' => 'required|numeric',
            'Alamat_Staff' => 'required|string',
            'Email_Staff' => 'required|email|unique:staff,Email_Staff',
            'Password_Staff' => 'required|string|min:6',
            'No_Hp_Staff' => ['required', 'regex:/^\+\d{7,15}$/'],
        ], [
            'No_Hp_Staff.regex' => 'The phone number must start with + followed by the country code and digits.',
        ]);

        // Generate unique ID_Staff in format: 0001Ram
        $prefix = strtoupper(substr(preg_replace('/\s+/', '', $request->Nama_Staff), 0, 3));
        $count = Staff::where('ID_Staff', 'like', '%'.$prefix)->count();
        $number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $newID = $number . $prefix;

        // Create the staff
        $staff = Staff::create([
            'ID_Staff' => $newID,
            'Nama_Staff' => $request->Nama_Staff,
            'NIK_Staff' => $request->NIK_Staff,
            'Alamat_Staff' => $request->Alamat_Staff,
            'Email_Staff' => $request->Email_Staff,
            'Password_Staff' => $request->Password_Staff, // hashed by model mutator
            'No_Hp_Staff' => $request->No_Hp_Staff,
            'Status_Staff' => 'Aktif'
        ]);

        return response()->json([
            'message' => 'Staff created successfully',
            'data' => $staff
        ], 201);
    }
}
