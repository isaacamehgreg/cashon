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
            $table->id();
            $table->integer('cashier_id');
            $table->integer('agent_id');
            $table->string('status');
            $table->integer('cash_allocated');
            $table->integer('cash_remitted');
            $table->string('area')->nullable();
            $table->string('phone')->nullable();
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
