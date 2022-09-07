<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\WeatherForecast;
use App\Http\Resources\WeatherForecastResource;



class WeatherForecastController extends BaseController
{

    public function index()
    {
        try {
            $weatherForecasts = WeatherForecast::orderBy('city')->paginate();
            return WeatherForecastResource::collection($weatherForecasts);
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong :(', $e);
        }
    }

    public function fetchThirdPartyApiForecast($city) {
        $baseApiUrl = env('WEATHER_FORECAST_API_BASE_URL');
        $apiKey = env('WEATHER_FORECAST_API_KEY');

        $endpoint = $baseApiUrl . '/weather?q='. $city . '&appid=' . $apiKey;
        $response = Http::get($endpoint);

        return json_decode($response->body());
    }

    public function create($city)
    {
        try {
            $weatherFromAPI = $this->fetchThirdPartyApiForecast($city);

            $result = WeatherForecast::updateOrCreate(['city' => strToLower($city)],[
                'date' => $weatherFromAPI->dt,
                'city' => strToLower($weatherFromAPI->name),
                'country_code' => $weatherFromAPI->sys->country,
                'timezone' => $weatherFromAPI->timezone,
                'sunrise' => $weatherFromAPI->sys->sunrise,
                'sunset' => $weatherFromAPI->sys->sunset,
                'main_temp' => $weatherFromAPI->main->temp,
                'main_feels_like' => $weatherFromAPI->main->feels_like,
                'main_temp_min' => $weatherFromAPI->main->temp_min,
                'main_temp_max' => $weatherFromAPI->main->temp_max,
                'main_pressure' => $weatherFromAPI->main->pressure,
                'main_humidity' => $weatherFromAPI->main->humidity,
                'clouds_all' => $weatherFromAPI->clouds->all,
                'visibility' => $weatherFromAPI->visibility,
                'wind_speed' => $weatherFromAPI->wind->speed,
                'wind_deg' => $weatherFromAPI->wind->deg ?? null,
                'wind_gust' => $weatherFromAPI->wind->gust ?? null,
                'weather_main' => $weatherFromAPI->weather[0]->main,
                'weather_description' => $weatherFromAPI->weather[0]->description,
                'weather_icon' => $weatherFromAPI->weather[0]->icon,
                'coordinate_lon' => $weatherFromAPI->coord->lon,
                'coordinate_lat' => $weatherFromAPI->coord->lat,
            ]);

            return $this->sendResponse($result, 'Weather forecast created');

        } catch (\Exception $e) {
            return $this->sendError('Weather forecast data could not be saved', $e);
        }
    }
    
    public function store(Request $request)
    {
        $city = $request->city;
        $response = $this->create($city);
        $success =json_decode(json_encode($response))->original->success;

        if (!$success) {
            return $this->sendError('Weather forecast data not available', []);
        } 
        return $response;
    }


    public function show($city)
    {
        try {
            $weatherForecastForCity = WeatherForecast::where('city', $city)->first();

            if ($weatherForecastForCity == null) {
                $response = $this->create($city);
                $jsonResonse = json_decode(json_encode($response))->original;
                $success = $jsonResonse->success;

                if (!$success) {
                    return $this->sendError('Weather forecast data not available', []);
                } 
                return new WeatherForecastResource($jsonResonse->data);
            } 

            return  new WeatherForecastResource($weatherForecastForCity);

        } catch (\Exception $e) {
            return $e;
            return $this->sendError('Something went wrong!', []);

        }
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
