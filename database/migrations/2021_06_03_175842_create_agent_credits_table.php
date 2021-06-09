<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_credits', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->integer('cash_allocated')->nullable();
            $table->integer('cash_remitted')->nullable();
            $table->integer('pending')->nullable();;// difference allocated and remitted
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
        Schema::dropIfExists('agent_credits');
    }
}
