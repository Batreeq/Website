<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $guard = 'drivers';

    protected $fillable = [
        'phone', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
