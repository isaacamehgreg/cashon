<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreToBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bets', function (Blueprint $table) {
            
            $table->integer('draw');
            $table->string('day');
            $table->integer('time');
            $table->string('game_name');
            $table->integer('combo2');
            $table->integer('combo3');
            $table->integer('combo4');
            $table->integer('combo5');
            $table->integer('combo6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
}
