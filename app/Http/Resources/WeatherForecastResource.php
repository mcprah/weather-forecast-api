<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'country_code' =>$this->country_code,
            'date' => date("F j, Y, g:i a", $this->date),
            'timezone' =>  $this->timezone,
            'sunrise' => date("F j, Y, g:i a", $this->sunrise),
            'sunset' => date("F j, Y, g:i a", $this->sunset),
            'main_temp' =>$this->main_temp,
            'main_feels_like' =>$this->main_feels_like,
            'main_temp_min' =>$this->main_temp_min,
            'main_temp_max' =>$this->main_temp_max,
            'main_pressure' =>$this->main_pressure,
            'main_humidity' =>$this->main_humidity,
            'clouds_all' =>$this->clouds_all,
            'visibility' =>$this->visibility,
            'wind_speed' =>$this->wind_speed,
            'wind_deg' =>$this->wind_deg ,
            'wind_gust' =>$this->wind_gust ,
            'weather_main' =>$this->weather_main,
            'weather_description' =>$this->weather_description,
            'weather_icon' =>$this->weather_icon,
            'coordinate_lon' =>$this->coordinate_lon,
            'coordinate_lat' =>$this->coordinate_lat,
        ];
    }
}
