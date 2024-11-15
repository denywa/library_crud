<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cd extends Model
{
    protected $fillable = [
        'title',
        'artist',
        'release_year',
    ];
}
