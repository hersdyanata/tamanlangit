<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wahana_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wahana_id');
            $table->string('name', 50);
            $table->string('status', 2);
            $table->dateTime('last_checkin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wahana_rooms');
    }
};
