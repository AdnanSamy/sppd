<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnItemDinasTravelTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_dinas_travel', function (Blueprint $table) {
            $table->dropForeign('item_dinas_travel_dinas_travel_id_foreign');
            $table->dropColumn(['price', 'dinas_travel_id']);
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
