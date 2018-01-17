<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('game')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('photo')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->string('location_url');
            $table->string('status');
            $table->float('score_nctu')->unsigned()->nullable();
            $table->float('score_nthu')->unsigned()->nullable();
            $table->float('score_draw')->unsigned()->nullable()->default(NULL);
            $table->text('info_entry')->nullable();
            $table->text('info_rule')->nullable();
            $table->boolean('is_ticket');
            $table->boolean('is_broadcast');
            $table->string('broadcast_url')->nullable();
            $table->text('broadcast_org')->nullable();
            $table->text('broadcast_anchor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
