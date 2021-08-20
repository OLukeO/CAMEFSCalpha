<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbeaconLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibeacon_location', function (Blueprint $table) //是否可傳uuid?
        {
            $table->id();
            $table->Integer('major');
            $table->Integer('minor');
            $table->decimal('lan', 10, 4); //點出的位置, 非beacon位置
            $table->decimal('lng', 10, 4);
            $table->string('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ibeaconlocation');
    }
}
