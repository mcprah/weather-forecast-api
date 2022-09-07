<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'city',
        'country_code',
        'timezone',
        'sunrise',
        'sunset',
        'main_temp',
        'main_feels_like',
        'main_temp_min',
        'main_temp_max',
        'main_pressure',
        'main_humidity',
        'clouds_all',
        'visibility',
        'wind_speed',
        'wind_deg',
        'wind_gust',
        'weather_main',
        'weather_description',
        'weather_icon',
        'coordinate_lon',
        'coordinate_lat',
    ];


}
