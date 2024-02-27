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
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_num', 20);
            $table->string('trans_via', 8);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('night_count');
            $table->dateTime('checkin_date')->nullable();
            $table->dateTime('checkout_date')->nullable();
            $table->bigInteger('wahana_id');
            $table->bigInteger('room_id');
            $table->string('name', 100);
            $table->string('email', 50);
            $table->string('wa_number', 15);
            $table->integer('persons');
            $table->integer('price');
            $table->integer('subtotal');
            $table->integer('ppn')->nullable();
            $table->integer('ppn_amount')->nullable();
            $table->integer('total_amount');
            $table->bigInteger('coupon_id')->nullable();
            $table->integer('discount')->nullable();
            $table->string('discount_type', 15)->nullable();
            $table->integer('discount_amount')->nullable();
            $table->string('payment_status', 10)->nullable();
            $table->string('cancel_flag', 1)->nullable();
            $table->string('cancel_reason')->nullable();
            $table->string('complete_flag', 1)->nullable();
            $table->integer('eo_id')->nullable();
            $table->integer('eo_commission')->nullable();
            $table->string('eo_commission_type', 15)->nullable();
            $table->integer('eo_total_commission')->nullable();
            $table->integer('omzet');
            $table->timestamps();

            $table->index(['id', 'trans_num', 'trans_via', 'start_date', 'end_date', 'checkin_date', 'checkout_date', 'wahana_id', 'room_id', 'coupon_id', 'payment_status', 'cancel_flag', 'complete_flag', 'eo_id'], 'rv_index');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
