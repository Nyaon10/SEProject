<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReviewRental extends Model
{
    use HasFactory;

    protected $table = 'review_rental';
    protected $primaryKey = 'ID_Review';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Review',
        'ID_Pelanggan',
        'ID_Pesanan',
        'ID_Barang',
        'Rating',
        'Review',
        'Kondisi_Pengembalian',
        'Tanggal_Review',
    ];

    protected $casts = [
        'Rating' => 'integer',
        'Tanggal_Review' => 'date',
    ];

    public function setTanggalReviewAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Review'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'ID_Pesanan', 'ID_Pesanan');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_Pelanggan', 'ID_Pelanggan');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ID_Barang', 'ID_Barang');
    }
}
