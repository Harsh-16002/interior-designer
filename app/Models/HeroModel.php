<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroModel extends Model
{
    use HasFactory;

    protected $table = 'herocontents';

    protected $fillable = [
       'slide_image',
       'heading',
       'fblink',
       'instralink',
       'twitterlink',
       'linkdinlink',
    ];
}
