<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbeaconlocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibeaconlocation', function (Blueprint $table) {
            $table->id(); //BeaconID
            $table->Integer('major');
            $table->Integer('minor');
            $table->decimal('lan', 10, 4);
            $table->decimal('lng', 10, 4);
            $table->text('uuid');
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
