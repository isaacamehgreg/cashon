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
            $table->string('cashier_id');
            $table->string('game_code');
           
            $table->integer('n1');
            $table->integer('n2');
            $table->integer('n3');
            $table->integer('n4');
            $table->integer('n5');
            $table->integer('n6')->nullable();
            $table->integer('stake');

            $table->integer('bet_code'); 
            $table->string('result')->nullable();
            
            $table->string('ticket_number')->nullable();
         
            $table->integer('min_potential_winning')->nullable();
            $table->integer('max_potential_winning')->nullable();
           
            $table->string('status')->nullable();#boolean /pending/win/lost/canceled
           
          
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
