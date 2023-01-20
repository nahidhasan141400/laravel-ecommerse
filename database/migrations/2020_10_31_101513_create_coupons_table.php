<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("type");
            $table->string("code");
            $table->string("category_id")->nullable();
            $table->string("subcategory_id")->nullable();
            $table->string("product_id")->nullable();
            $table->string("discount");
            $table->string("maximum_discount_amount")->nullable();
            $table->string("minimum_shopping_amount")->nullable();
            $table->string("start_date");
            $table->string("end_date");
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
        Schema::dropIfExists('coupons');
    }
}
