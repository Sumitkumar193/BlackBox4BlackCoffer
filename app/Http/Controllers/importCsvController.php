<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Pestle;
use App\Models\Swot;
use App\Models\Sector;
use App\Models\Topic;
use App\Models\City;
use App\Models\Country;
use App\Models\Data;
use App\Models\Region;
use Carbon\Carbon;

class importCsvController extends Controller
{

    public function importCsv()
    {
        $file = public_path('uploads/Data.csv');

        $allCsvData = $this->csvToArray($file);
        foreach ($allCsvData as $data) {
            //Add region if not exist and is not null
            if ($data['region'] != null) {
                $region = Region::firstOrCreate(['region_name' => mb_convert_encoding($data['region'], 'UTF-8', 'UTF-8')]);
            }
            //Add country if not exist and is not null
            if ($data['country'] != null) {
                $country = Country::firstOrCreate(['country_name' => mb_convert_encoding($data['country'], 'UTF-8', 'UTF-8'), 'region_id' => $region->id ?? null]);
            }
            //Add city if not exist and is not null
            if ($data['city'] != null) {
                $city = City::firstOrCreate([
                    'city_name' => mb_convert_encoding($data['city'], 'UTF-8', 'UTF-8'),
                    'city_lon' => $data['citylng'],
                    'city_lat' => $data['citylat'],
                    'country_id' => $country->id ?? null,
                ]);
            }
            //Add topic if not exist and is not null
            if ($data['topic'] != null) {
                $topic = Topic::firstOrCreate(['topic_name' => mb_convert_encoding($data['topic'], 'UTF-8', 'UTF-8')]);
            }
            //Add sector if not exist and is not null
            if ($data['sector'] != null) {
                $sector = Sector::firstOrCreate(['sector_name' => mb_convert_encoding($data['sector'], 'UTF-8', 'UTF-8')]);
            }
            //Add swot if not exist and is not null
            if ($data['swot'] != null) {
                $swot = Swot::firstOrCreate(['swot_name' => mb_convert_encoding($data['swot'], 'UTF-8', 'UTF-8')]);
            }
            //Add pestle if not exist and is not null
            if ($data['pestle'] != null) {
                $pestle = Pestle::firstOrCreate(['pestle_name' => mb_convert_encoding($data['pestle'], 'UTF-8', 'UTF-8')]);
            }
            //Add source if not exist and is not null
            if ($data['source'] != null) {
                $source = Source::firstOrCreate(['source_name' => mb_convert_encoding($data['source'], 'UTF-8', 'UTF-8')]);
            }

            $added = Carbon::createFromFormat('M, d Y H:i:s', $data['added']) ?? null;
            $published = Carbon::createFromFormat('M, d Y H:i:s', $data['published']) ?? null;

            $data = Data::firstOrCreate([
                'title' => mb_convert_encoding($data['title'], 'UTF-8', 'UTF-8'),
                'insight' => mb_convert_encoding($data['insight'], 'UTF-8', 'UTF-8'),
                'url' => mb_convert_encoding($data['title'], 'UTF-8', 'UTF-8'),
                'intensity' => (int)$data['intensity'],
                'relevance' => (int)$data['relevance'],
                'likelyhood' => (int)$data['likelihood'],
                'impact' => (int)$data['impact'],
                'topic_id' => $topic->id ?? null,
                'sector_id' => $sector->id ?? null,
                'swot_id' => $swot->id ?? null,
                'pestle_id' => $pestle->id ?? null,
                'source_id' => $source->id ?? null,
                'city_id' => $city->id ?? null,
                'country_id' => $country->id ?? null,
                'region_id' => $region->id ?? null,
                'start_year' => (int)$data['start_year'],
                'end_year' => (int)$data['end_year'],
                'added' => $added,
                'published' => $published
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data imported successfully'
        ], 200);
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
