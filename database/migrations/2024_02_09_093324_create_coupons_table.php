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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30);
            $table->string('description', 100);
            $table->string('status', 2); // A: Aktif, NA: Tidak Aktif, E: Kadaluarsa
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quantity');
            $table->integer('balance');
            $table->string('discount_type', 15); // persentase / nominal
            $table->integer('discount');
            $table->string('valid_for', 20); // online / onsite / both
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
