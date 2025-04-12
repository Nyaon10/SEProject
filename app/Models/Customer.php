<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'ID_Pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $fillable = [
        'ID_Pelanggan',        
        'NIK_Pelanggan',    
        'Nama_Pelanggan',  
        'Alamat_Pelanggan', 
        'Email_Pelanggan', 
        'Password_Pelanggan',
        'No_Hp_Pelanggan', 
        'Akun_Instagram', 
        'Blacklist_status',
        'Status_Pelanggan',
    ];

    protected $hidden = [
        'Password_Pelanggan',
    ];

    protected $casts = [
        'NIK_Pelanggan' => 'integer',
        'Blacklist_status' => 'boolean',
    ];

    public function setPasswordPelangganAttribute($value)
    {
        if (!empty($value) && !password_get_info($value)['algo']) {
            $this->attributes['Password_Pelanggan'] = Hash::make($value);
        } else {
            $this->attributes['Password_Pelanggan'] = $value;
        }
    }
}
