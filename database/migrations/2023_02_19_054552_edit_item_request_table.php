<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditItemRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_request', function (Blueprint $table) {
            $table->dropForeign('item_request_dinas_travel_id_foreign');
            $table->dropForeign('item_request_item_dinas_travel_id_foreign');

            $table->foreign('dinas_travel_id')->references('id')->on('dinas_travel')->onDelete('cascade');
            $table->foreign('item_dinas_travel_id')->references('id')->on('item_dinas_travel')->onDelete('cascade');
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
