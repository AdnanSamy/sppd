<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinasTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinas_travel', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul');
            $table->string('status');
            $table->text('bukti_transfer');
            $table->unsignedBigInteger('approved_id');
            $table->foreign('approved_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dinas_travel');
    }
}
