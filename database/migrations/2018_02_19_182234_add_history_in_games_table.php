<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHistoryInGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('history_nctu')->unsigned()->default('0');
            $table->integer('history_nthu')->unsigned()->default('0');
            $table->integer('history_draw')->unsigned()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('history_nctu');
            $table->dropColumn('history_nthu');
            $table->dropColumn('history_draw');
        });
    }
}
