<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{

    protected $fillable = ['id', 'product_id', 'warna_id', 'ukuran_id', 'stok', 'gambar'];

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

    public function produk_masuk()
    {
        return $this->belongsTo(Product_Masuk::class);
    }

    public function produk_keluar()
    {
        return $this->belongsTo(Product_Keluar::class);
    }
}
