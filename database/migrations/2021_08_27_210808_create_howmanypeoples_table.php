<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowmanypeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('howmanypeoples', function (Blueprint $table) {
            $table->id();
            $table->datetime('logtime')->default(now());;
            $table->integer('aid');
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
        Schema::dropIfExists('howmanypeoples');
    }
}
