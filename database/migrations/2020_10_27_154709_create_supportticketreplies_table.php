<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportticketrepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supportticketreplies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supportticket_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('admin');
            $table->string('reply');
            $table->unsignedBigInteger('sender')->default(0);
            $table->unsignedBigInteger('receiver')->default(0);
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supportticketreplies');
    }
}
