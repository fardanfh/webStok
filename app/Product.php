<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['kode_barang', 'category_id', 'nama', 'harga', 'harga_jual', 'image', 'qty'];

    protected $hidden = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detail()
    {
        return $this->belongsTo(DetailProduct::class);
    }
}
