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
        Schema::create('reservation_extra_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reservation_id');
            $table->string('type', 10);
            $table->bigInteger('stock_id')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('subtotal');

            $table->index(['reservation_id', 'type', 'stock_id'], 'rev_extra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_extra_services');
    }
};
