<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiskonGrosir;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama_produk',
    'deskripsi',
    'harga',
    'stok',
    'status',
    'kategori',
    'user_id',
    'is_grosir',
    'gambar',
    

];

    protected $casts = [
        'harga' => 'decimal:2',
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

// Accessor untuk format harga
public function getFormattedHargaAttribute()
{
    return 'Rp ' . number_format($this->harga, 0, ',', '.');
}

}
