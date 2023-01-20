<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();
            $table->string('order_code');
            $table->string('cart_details');
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('amount');
            $table->string('currency')->default('BDT');
            $table->string('status')->nullable();
            $table->string('shipping')->nullable();
            $table->unsignedBigInteger('is_paid')->default(0);
            $table->unsignedBigInteger('is_completed')->default(0);
            $table->string('ip_address')->nullable();
            $table->unsignedBigInteger('notify')->default(0);
            $table->unsignedBigInteger('shipping_area');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
