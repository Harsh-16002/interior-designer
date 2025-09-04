<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyUsModel extends Model
{
    protected $table = 'Why-Us';

    protected $fillable = [

        'main_heading',
        'image',
        'title',


    ];
}
