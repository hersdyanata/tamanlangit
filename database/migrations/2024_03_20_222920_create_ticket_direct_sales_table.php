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
        Schema::create('ticket_direct_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_num', 20);
            $table->datetime('trans_date');
            $table->string('name', 150)->nullable();
            $table->integer('amount');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_direct_sales');
    }
};
