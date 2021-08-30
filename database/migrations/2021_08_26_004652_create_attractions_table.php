<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->integer('beaconid');
            $table->decimal('lat', 10, 4);
            $table->decimal('lng', 10, 4);
            $table->string('viewname',32);
            $table->string('note',1024);
            $table->string('image',255);
            $table->string('url',255);
            $table->datetime('logtime')->default(now());;
            $table->integer('peoplenumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attractions');
    }
}
