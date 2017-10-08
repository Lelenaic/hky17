<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charging_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('station_id');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('owner');
            $table->string('rechargeType');
            $table->integer('rechargePoint');
            $table->string('connectorType');
            $table->tinyInteger('state')->default(1);
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
        Schema::dropIfExists('charging_stations');
    }
}
