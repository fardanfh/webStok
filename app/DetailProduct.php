<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{

    protected $table = 'detail_product';
    protected $fillable = ['id', 'product_id', 'warna_id', 'ukuran_id', 'stok'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class);
    }

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class);
    }
}
