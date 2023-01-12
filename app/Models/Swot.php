<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swot extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'swot';

    protected $fillable = ['swot_name'];
}
