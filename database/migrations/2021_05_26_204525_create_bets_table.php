<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id');
            $table->string('terminal_id');
            $table->string('bet_code');
            $table->integer('n1');
            $table->integer('n2');
            $table->integer('n3');
            $table->integer('n4');
            $table->integer('n5');
            $table->string('status');#boolean /about_to_start/win/lost/canceled/paid/expired/
            $table->integer('stake');
            $table->integer('potential_winning')->nullable();
            $table->string('ticket_number')->nullable();
            $table->string('result')->nullable();
            $table->integer('combination')->nullable();
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
        Schema::dropIfExists('bets');
    }
}
