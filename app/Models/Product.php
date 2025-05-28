<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DiskonGrosir;

class Product extends Model
{
    protected $fillable = [
    'nama_produk',
    'deskripsi',
    'harga',
    'stok',
    'user_id',
    'is_grosir',
    'gambar',
    

];

    protected $casts = [
        'is_grosir' => 'boolean',
    ];

public function user()
{
    return $this->belongsTo(User::class);
}

public function diskonGrosir()
{
    return $this->hasMany(DiskonGrosir::class, 'product_id');
}


}
