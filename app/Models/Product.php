<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'ID_Barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Barang',
        'Nama_Barang',
        'Deskripsi_Barang',
        'Gambar_Barang',
        'ID_Kategori',
        'Jumlah_Barang',
        'Harga_Barang',
        'Tanggal_Stok_Barang',
        'Keterangan',
        'Status_Barang',
    ];

    protected $casts = [
        'Gambar_Barang' => 'array',
        'ID_Kategori' => 'integer',
        'Jumlah_Barang' => 'integer',
        'Harga_Barang' => 'decimal:2',
        'Tanggal_Stok_Barang' => 'date'
    ];

    public function setTanggalStokBarangAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['Tanggal_Stok_Barang'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getTanggalStokBarangAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y') : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'ID_Kategori', 'ID_Kategori'); 
    }
}
