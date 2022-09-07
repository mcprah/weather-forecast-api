<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class WeatherForecastTest extends TestCase
{
    
    public function test_weather_update()
    {
        $city = "Accra";
        $response = $this->get('/api/v1/weather-forecast/'.$city);
        $response->assertStatus(200);
    }
}
