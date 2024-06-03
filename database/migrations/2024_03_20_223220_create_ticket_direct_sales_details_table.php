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
        Schema::create('ticket_direct_sales_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trans_id');
            $table->bigInteger('ticket_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_direct_sales_details');
    }
};
