<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashdealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashdeals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id');
            $table->string('title');
            $table->string('discount');
            $table->string('start');
            $table->string('end');
            $table->string('code');
            $table->string('url');
            $table->string('added_by');
            $table->unsignedInteger('status')->default(0);
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
        Schema::dropIfExists('flashdeals');
    }
}
