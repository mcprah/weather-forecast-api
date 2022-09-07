<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Api\v1\WeatherForecastController;

class CheckWeather extends Command
{

    protected $signature = 'weather:check';


    protected $description = 'Checks weather for cities';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        try {
            info("Weather forecasting started...");
            
            $weatherForecastController = new WeatherForecastController();
            $cities = ["New York","London","Paris","Berlin","Tokyo"];
            
            foreach ($cities as  $city) {
                $weatherForecastController->show($city);
                info("...forecasted for " . $city);
            }

            info("Weather forecasting completed");
            
        } catch (\Exception $e) {
            info($e);
        }

    }
}
