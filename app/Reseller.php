<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Reseller extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';

    protected $fillable = ['email',  'password'];

    protected $hidden = ['password'];
}
