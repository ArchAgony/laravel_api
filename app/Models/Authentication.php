<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    //
    protected $fillable = [
        'email',
        'password',
        'name'
    ];
}