<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model
{
    protected $table='about';
    
    protected $fillable = [

        'title',
        'main_heading',
        'para1',
        'para2',
        'image',

    ];
}
