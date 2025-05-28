<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiskonGrosir extends Model
{
    protected $table = 'diskon_grosir';

    protected $fillable = [
        'product_id',
        'minimal_jumlah',
        'persentase_diskon',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
