<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kindOfRoom')->unsigned();
            $table->foreign('kindOfRoom')->references('id')->on('kind_of_rooms')->onDelete('cascade');
            $table->string('name')->unique();
            $table->boolean('isUsed')->default(0);
            $table->boolean('isCleaned')->default(1);
            $table->boolean('isFixed')->default(0);
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
        Schema::dropIfExists('rooms');
    }
}
