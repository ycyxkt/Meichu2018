<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVr360AndVr360UrlAndVr360InfoInGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            //
            $table->boolean('is_vr360')->default(false);
            $table->string('vr360_url')->nullable();
            $table->text('vr360_info')->nullable();
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
            //
            $table->dropColumn('is_vr360');
            $table->dropColumn('vr360_url');
            $table->dropColumn('vr360_info');
        });
    }
}
