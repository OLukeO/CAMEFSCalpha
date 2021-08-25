<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *正在使用安全通道
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring', function (Blueprint $table)
        {
            $table->id();
            $table->string('uid')->unique();
            $table->decimal('lan', 10, 4);
            $table->decimal('lng', 10, 4);
            $table->boolean('sos')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
}
