<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('city')->nullable();
            $table->string('country_code')->nullable();
            $table->string('timezone')->nullable();
            $table->string('sunrise')->nullable();
            $table->string('sunset')->nullable();
            $table->double('main_temp')->nullable();
            $table->double('main_feels_like')->nullable();
            $table->double('main_temp_min')->nullable();
            $table->double('main_temp_max')->nullable();
            $table->double('main_pressure')->nullable();
            $table->integer('main_humidity')->nullable();
            $table->integer('clouds_all')->nullable();
            $table->integer('visibility')->nullable();
            $table->double('wind_speed')->nullable();
            $table->double('wind_deg')->nullable();
            $table->double('wind_gust')->nullable();
            $table->string('weather_main')->nullable();
            $table->string('weather_description')->nullable();
            $table->string('weather_icon')->nullable();
            $table->double('coordinate_lon')->nullable();
            $table->double('coordinate_lat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
}
