<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'nama_produk',
    'deskripsi',
    'harga',
    'stok',
    'user_id',


];

public function user()
{
    return $this->belongsTo(User::class);
}


}
