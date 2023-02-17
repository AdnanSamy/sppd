<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_request', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('dinas_travel_id');
            $table->foreign('dinas_travel_id')->references('id')->on('dinas_travel');

            $table->unsignedBigInteger('item_dinas_travel_id');
            $table->foreign('item_dinas_travel_id')->references('id')->on('item_dinas_travel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_request');
    }
}
