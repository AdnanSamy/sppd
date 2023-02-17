<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditDinasTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dinas_travel', function (Blueprint $table) {
            $table->string('judul')->nullable()->change();
            $table->integer('total')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->text('bukti_transfer')->nullable()->change();
            $table->unsignedBigInteger('approved_id')->nullable()->change();
            $table->integer('total')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
