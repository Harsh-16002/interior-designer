<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounterModel extends Model
{
    protected $table='counters';

    protected $fillable =[
        'projects_completed',
        'happy_clients',
        'cup_of_coffee',
        'awards_received',


    ];
}
