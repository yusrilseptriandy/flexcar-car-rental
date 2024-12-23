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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable('false');
            $table->date('start_date')->nullable('false');
            $table->date('end_date')->nullable('false');

            //address
            $table->text('address')->nullable('false');
            $table->string('city')->nullable('false');
            $table->string('zip')->nullable('false');

            //status
            $table->string('status')->default('pending');

            //payment
            $table->string('payment_method')->default('cash');

            //total price
            $table->integer('total_price')->default(0);

            $table->foreignId('user_id')->constrained();
            $table->foreignId('item_id')->constrained();


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
