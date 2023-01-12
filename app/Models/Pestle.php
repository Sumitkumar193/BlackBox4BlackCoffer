<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pestle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pestle';

    protected $fillable = ['pestle_name'];
}
