<?php

namespace App;

use Illuminate\Foundation\Auth\User as Model;

class Customer extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['nama', 'alamat', 'email', 'password', 'telepon'];

    protected $hidden = ['created_at', 'updated_at', 'password'];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
