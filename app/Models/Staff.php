<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    protected $primaryKey = 'ID_Staff';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Staff',
        'NIK_Staff',
        'Nama_Staff',
        'Alamat_Staff',
        'Email_Staff',
        'Password_Staff',
        'No_Hp_Staff',
        'Status_Staff'
    ];

    protected $hidden = [
        'Password_Staff'
    ];

    protected $casts = [
        'NIK_Staff' => 'integer',
    ];

    public function setPasswordStaffAttribute($value)
    {
        if (!empty($value) && !password_get_info($value)['algo']) {
            $this->attributes['Password_Staff'] = Hash::make($value);
        } else {
            $this->attributes['Password_Staff'] = $value;
        }
    }
}
