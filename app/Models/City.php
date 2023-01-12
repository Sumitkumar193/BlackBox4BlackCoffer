<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cities';

    protected $fillable = [
        'city_name',
        'city_lon',
        'city_lat',
        'country_id',
    ];
}
