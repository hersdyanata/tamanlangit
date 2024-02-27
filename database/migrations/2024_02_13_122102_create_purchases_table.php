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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_num', 8);
            $table->dateTime('trans_date');
            $table->string('supplier_id');
            $table->integer('amount');
            $table->integer('ppn')->nullable();
            $table->integer('ppn_amount')->nullable();
            $table->integer('total_amount');
            $table->string('non_stock', 10);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
