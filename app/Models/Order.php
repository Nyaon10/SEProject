<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'ID_Pesanan';
    public $incrementing = false;
    protected $keyType = 'string'; 
    protected $fillable = [
        'ID_Pesanan',
        'ID_Pelanggan',
        'Tanggal_Pesanan',
        'Status_Pesanan',
        'Total_Harga',
        'Metode_Pembayaran',
    ];

    protected $casts = [
        'Tanggal_Pesanan' => 'date',
        'Total_Harga' => 'decimal:2'

    ];

    public function setTanggalPesananAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Pesanan'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getTanggalPesananAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y') : null;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_Pelanggan', 'ID_Pelanggan');
    }
}