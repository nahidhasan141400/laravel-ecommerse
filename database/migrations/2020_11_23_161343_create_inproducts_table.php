<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('added_by');
            $table->string('image');
            $table->unsignedInteger('quentity');
            $table->unsignedInteger('current_quentity');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('current_location');
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
        Schema::dropIfExists('inproducts');
    }
}
