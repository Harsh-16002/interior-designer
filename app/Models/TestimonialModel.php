<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialModel extends Model
{
    protected $table='testimonials';

    protected $fillable = [

        'name',
        'position',
        'image',
        'review',


    ];
}
