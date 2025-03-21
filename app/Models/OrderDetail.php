<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $primaryKey = 'ID_Detail_Pesanan';
    public $incrementing = true;

    protected $fillable = [
        'ID_Pesanan',
        'ID_Barang',
        'Jumlah_Barang',
        'Harga_Satuan',
        'Subtotal',
    ];

    protected $casts = [
        'Jumlah_Barang' => 'integer',
        'Harga_Satuan' => 'decimal:2',
        'Subtotal' => 'decimal:2'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'ID_Pesanan', 'ID_Pesanan');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ID_Barang', 'ID_Barang');
    }
}
