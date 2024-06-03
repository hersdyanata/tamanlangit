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
        Schema::create('ticket_presale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 8);
            $table->string('description', 50);
            $table->integer('quantity');
            $table->string('category', 30);
            $table->string('status', 15);
            $table->integer('price');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->index(['id', 'code', 'description', 'valid_from', 'valid_to', 'category', 'status'], 'tickets_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
