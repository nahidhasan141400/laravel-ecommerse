<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('quentity');
            $table->unsignedBigInteger('category_id');
            $table->unsignedInteger('childcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->string('customer_choice')->nullable();
            $table->string('tag');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('purchase_price');
            $table->unsignedInteger('current_stock');
            $table->unsignedInteger('discount')->default(0)->nullable();
            $table->unsignedInteger('vat')->default(15);
            $table->unsignedInteger('shipping_cost')->nullable();
            $table->unsignedInteger('num_of_sale')->default(0);
            $table->string('title');
            $table->string('description');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('slug');
            $table->unsignedInteger('rating')->default(0);
            // $table->string('video_link')->nullable();
            $table->string('added_by');
            $table->string('product_type');
            $table->string('flash_deal_image')->nullable();
            // $table->string('special_product_image')->nullable();
            // $table->string('featured_product_image')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('flash_deal_status')->default(0);
            // $table->unsignedTinyInteger('special_status')->default(0);
            // $table->unsignedInteger('featured_status')->default(0);
            $table->string('current_location');
            $table->string('finish_alert')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
