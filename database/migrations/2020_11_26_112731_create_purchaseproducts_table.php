<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('supplierlist_id');
            $table->string('chalan_no');
            $table->string('order_id');
            $table->string('name');
            $table->string('category');
            $table->string('amount');
            $table->string('quantity');
            $table->unsignedTinyInteger('status')->deafult(0);
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
        Schema::dropIfExists('purchaseproducts');
    }
}
