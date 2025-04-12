<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryRental extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_rental';
    protected $primaryKey = 'ID_Pengiriman';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Pengiriman',
        'ID_Pesanan',
        'Nama_Penerima',
        'No_Hp_Penerima',
        'Alamat_Pengiriman',
        'Kurir',
        'Tipe_Kurir',
        'Resi',
        'Status_Pengiriman',
        'Tanggal_Kirim',
        'Tanggal_Terima',
        'Tanggal_Pengembalian',
        'Status_Pengembalian',
        'Tanggal_Dikembalikan',
        'Jumlah_Hari_Overdue',
    ];

    protected $casts = [
        'Tanggal_Kirim' => 'date',
        'Tanggal_Terima' => 'date',
        'Tanggal_Pengembalian' => 'date',
        'Tanggal_Dikembalikan' => 'date',
        'Jumlah_Hari_Overdue' => 'integer',
    ];

    public function setTanggalKirimAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Kirim'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function setTanggalTerimaAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Terima'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function setTanggalPengembalianAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Pengembalian'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function setTanggalDikembalikanAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Dikembalikan'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'ID_Pesanan', 'ID_Pesanan');
    }
}
