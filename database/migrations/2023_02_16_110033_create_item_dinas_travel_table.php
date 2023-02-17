<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDinasTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_dinas_travel', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('item');
            $table->integer('price');

            $table->unsignedBigInteger('dinas_travel_id');
            $table->foreign('dinas_travel_id')->references('id')->on('dinas_travel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_dinas_travel');
    }
}
