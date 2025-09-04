<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    protected $table = 'services';

    protected $fillable = [

        'image',
        'title',
        'description'

    ];
}
