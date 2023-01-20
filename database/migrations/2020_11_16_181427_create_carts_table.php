<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->unsignedBigInteger('flashdeal_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('product_name')->nullable();
            $table->string('product_price')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('image')->nullable();
            $table->string('customer_choice')->nullable();
            $table->unsignedInteger('flashdeal')->default(0)->nullable();
            $table->unsignedInteger('product_quentity')->default(1);
            $table->unsignedInteger('product_free_quentity')->nullable();
            $table->string('review')->nullable();
            $table->string('ip');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
           
            $table->foreign('user_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
