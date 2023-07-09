<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{

    protected $fillable = ['nama', 'alamat', 'email', 'password', 'telepon'];

    protected $hidden = ['created_at', 'updated_at'];
}
