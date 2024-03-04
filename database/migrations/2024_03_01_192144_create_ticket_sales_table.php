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
        Schema::create('ticket_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_type', 10); // bulk, direct
            $table->bigInteger('ticket_batch_id');
            $table->string('serial_number', 10);
            $table->string('category', 20);
            $table->integer('price');
            $table->dateTime('sold_date');
            $table->bigInteger('created_by');

            $table->index(['trans_type', 'ticket_batch_id', 'serial_number', 'category', 'sold_date', 'created_by'], 'ticket_sales_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_sales');
    }
};
