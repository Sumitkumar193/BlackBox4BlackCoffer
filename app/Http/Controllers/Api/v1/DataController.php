<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function dataByRegion()
    {
        $data = Data::all()->groupBy('region_id');
        return response()->json($data);
    }

    public function dataByCountry()
    {
        $data = Data::all()->groupBy('country_id');
        return response()->json($data);
    }

    public function dataByTopics()
    {
        $data = Data::all()->groupBy('topic_id');
        return response()->json($data);
    }

    public function dataByCity()
    {
        $data = Data::all()->groupBy('city_id');
        return response()->json($data);
    }

    public function dataByEndYear()
    {
        $data = Data::all()->groupBy('end_year');
        return response()->json($data);
    }

    public function dataByRelevance()
    {
        $data = Data::all()->groupBy('relevance');
        return response()->json($data);
    }

    public function dataByLikelihood()
    {
        $data = Data::all()->groupBy('likelyhood');
        return response()->json($data);
    }

    public function dataByIntensity()
    {
        $data = Data::all()->groupBy('intensity');
        return response()->json($data);
    }

}
