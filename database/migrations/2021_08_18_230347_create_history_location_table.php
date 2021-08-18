<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_location', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique(); //感覺用學號紀錄比較好
            //$table->string('logtime'); timestamps即可
            $table->string('rssi');
            $table->string('distance');
            $table->string('txpower');
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
        Schema::dropIfExists('history_location');
    }
}
