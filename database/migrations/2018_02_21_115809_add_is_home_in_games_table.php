<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsHomeInGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            Schema::table('games', function (Blueprint $table) {
                $table->boolean('is_home')->default(true);
            });
            DB::table('games')->where('game', '=', 'kendo')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'billiards')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'chess')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'go')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'tennis')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'women-tennis')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'women-basketball')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'men-basketball')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'softball-general')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'softball-open')
                ->update([
                    "is_home" => "0",
            ]);
            DB::table('games')->where('game', '=', 'football-open')
                ->update([
                    "is_home" => "0",
            ]);
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
            $table->dropColumn('is_home');
        });
    }
}
