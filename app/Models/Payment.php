<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'ID_Pembayaran';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Pembayaran',
        'ID_Pesanan',
        'Tanggal_Pembayaran',
        'Jumlah_Bayaran_Terima',
        'Total_Tagihan',
        'Status_Pembayaran',
        'Metode_Pembayaran',
        'Bukti_Pembayaran',
        'Tipe_Transasksi',
    ];

    protected $casts = [
        'Tanggal_Pembayaran' => 'date',
        'Jumlah_Bayaran_Terima' => 'decimal:2',
        'Total_Tagihan' => 'decimal:2',
        'Bukti_Pembayaran' => 'array',
    ];

    public function setTanggalPembayaranAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Pembayaran'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getTanggalPembayaranAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y') : null;
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'ID_Pesanan');
    }
}
