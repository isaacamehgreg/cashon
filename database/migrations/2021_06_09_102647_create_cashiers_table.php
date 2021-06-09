<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->id('cashier_id');
            $table->integer('agent_id');
            $table->string('cashier_name')->nullable();
            $table->string('status')->nullable();//blocked/or not blocked
            $table->string('area')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->integer('cash_allocated')->nullable();
            $table->integer('cash_remitted')->nullable();
            $table->string('cashier_code');
            $table->string('cashier_password');
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
        Schema::dropIfExists('cashiers');
    }
}
