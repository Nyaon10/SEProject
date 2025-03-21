<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'ID_Kategori';
    public $incrementing = true;

    protected $fillable = [
        'Nama_Kategori',
    ];
}
