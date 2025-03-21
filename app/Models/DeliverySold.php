<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliverySold extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_jualan';
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
    ];

    protected $casts = [
        'Tanggal_Kirim' => 'date',
        'Tanggal_Terima' => 'date',
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

    public function order()
    {
        return $this->belongsTo(Order::class, 'ID_Pesanan', 'ID_Pesanan');
    }
}
