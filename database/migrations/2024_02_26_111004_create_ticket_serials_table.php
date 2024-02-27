<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_serials', function (Blueprint $table) {
            $table->bigInteger('ticket_id');
            $table->string('serial_number', 15);
            $table->integer('price');
            $table->string('status');
            $table->dateTime('sold_date')->nullable();

            $table->index(['ticket_id', 'serial_number', 'status', 'sold_date'], 'serial_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_serials');
    }
};
