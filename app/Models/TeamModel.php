<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    protected $table='team';

    protected $fillable=[

        'image',
        'name',
        'position',
        'bio',
        'facebook',
        'instagram',
        'twitter'


    ];
}
