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
        DB::table('games')->where('game', '=', 'football-general')
            ->update([
                "history_nctu" => "15",
                "history_nthu" => "10",
                "history_draw" => "5",
        ]);
        DB::table('games')->where('game', '=', 'kendo')
            ->update([
                "history_nctu" => "8",
                "history_nthu" => "1",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'billiards')
            ->update([
                "history_nctu" => "0",
                "history_nthu" => "5",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'women-tabletennis')
            ->update([
                "history_nctu" => "1",
                "history_nthu" => "7",
                "history_draw" => "1",
        ]);
        DB::table('games')->where('game', '=', 'tabletennis')
            ->update([
                "history_nctu" => "12",
                "history_nthu" => "16",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'badminton')
            ->update([
                "history_nctu" => "19",
                "history_nthu" => "9",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'men-badminton')
            ->update([
                "history_nctu" => "0",
                "history_nthu" => "0",
                "history_draw" => "2",
        ]);
        DB::table('games')->where('game', '=', 'bridge')
            ->update([
                "history_nctu" => "21",
                "history_nthu" => "16",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'chess')
            ->update([
                "history_nctu" => "23",
                "history_nthu" => "12",
                "history_draw" => "3",
        ]);
        DB::table('games')->where('game', '=', 'go')
            ->update([
                "history_nctu" => "2",
                "history_nthu" => "1",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'baseball')
            ->update([
                "history_nctu" => "17",
                "history_nthu" => "16",
                "history_draw" => "1",
        ]);
        DB::table('games')->where('game', '=', 'tennis')
            ->update([
                "history_nctu" => "17",
                "history_nthu" => "10",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'women-tennis')
            ->update([
                "history_nctu" => "9",
                "history_nthu" => "4",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'women-basketball')
            ->update([
                "history_nctu" => "14",
                "history_nthu" => "12",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'men-basketball')
            ->update([
                "history_nctu" => "11",
                "history_nthu" => "27",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'softball-general')
            ->update([
                "history_nctu" => "0",
                "history_nthu" => "3",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'men-volleyball')
            ->update([
                "history_nctu" => "19",
                "history_nthu" => "19",
                "history_draw" => "0",
        ]);
        DB::table('games')->where('game', '=', 'women-volleyball')
            ->update([
                "history_nctu" => "8",
                "history_nthu" => "16",
                "history_draw" => "0",
        ]);
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
