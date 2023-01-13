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
        
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $regionData = [
                    'region_name' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $region = \App\Models\Region::find($key);
                $regionData['region_name'] = $region->region_name ?? 'N/A';
                $regionData['data'] = $value;
                $json_data[] = (object)$regionData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByCountry()
    {
        $data = Data::all()->groupBy('country_id');
        
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $countryData = [
                    'country_name' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $country = \App\Models\Country::find($key);
                $countryData['country_name'] = $country->country_name ?? 'N/A';
                $countryData['data'] = $value;
                $json_data[] = (object)$countryData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByTopics()
    {
        $data = Data::all()->groupBy('topic_id');
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $topicData = [
                    'topic_name' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $topic = \App\Models\Topic::find($key);
                $topicData['topic_name'] = $topic->topic_name ?? 'N/A';
                $topicData['data'] = $value;
                $json_data[] = (object)$topicData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByCity()
    {
        $data = Data::all()->groupBy('city_id');
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $cityData = [
                    'city_name' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $city = \App\Models\City::find($key);
                $cityData['city_name'] = $city->city_name ?? 'N/A';
                $cityData['data'] = $value;
                $json_data[] = (object)$cityData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByEndYear()
    {
        $data = Data::all()->groupBy('end_year')->sortBy('end_year');
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $endYearData = [
                    'end_year' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $endYearData['end_year'] = $key;
                $endYearData['data'] = $value;
                $json_data[] = (object)$endYearData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByRelevance()
    {
        $data = Data::all()->groupBy('relevance');
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $relevanceData = [
                    'relevance' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $relevanceData['relevance'] = $key;
                $relevanceData['data'] = $value;
                $json_data[] = (object)$relevanceData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByLikelihood()
    {
        $data = Data::all()->groupBy('likelyhood');
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $likelihoodData = [
                    'likelihood' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $likelihoodData['likelihood'] = $key;
                $likelihoodData['data'] = $value;
                $json_data[] = (object)$likelihoodData;
            }
        }
        return response()->json($json_data);
    }

    public function dataByIntensity()
    {
        $data = Data::all()->groupBy('intensity');
        foreach ($data as $key => $value) {
            if ($key != "" || $key != null) {
                $intensityData = [
                    'intensity' => '',
                    'length' => $value->count(),
                    'data' => []
                ];
                $intensityData['intensity'] = $key;
                $intensityData['data'] = $value;
                $json_data[] = (object)$intensityData;
            }
        }
        return response()->json($json_data);
    }
}
