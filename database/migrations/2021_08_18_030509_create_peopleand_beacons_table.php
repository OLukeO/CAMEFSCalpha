<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleandBeaconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peopleandbeacons', function (Blueprint $table) {
            $table->id();
            $table->dateTime('logtime')->default(now());
            $table->integer('beaconid');
            $table->string('rssi');
            $table->string('distance');
            $table->string('txpower');
            $table->integer('uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peopleandbeacons');
    }
}
