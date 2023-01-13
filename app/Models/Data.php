<?php

namespace App\Models;

use App\Models\Sector;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'data';

    protected $fillable = [
        'title',
        'insight',
        'url',
        'intensity',
        'relevance',
        'likelyhood',
        'impact',
        'topic_id',
        'sector_id',
        'swot_id',
        'pestle_id',
        'source_id',
        'region_id',
        'country_id',
        'city_id',
        'start_year',
        'end_year',
        'added',
        'published'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class)->select('topic_name');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
