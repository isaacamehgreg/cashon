<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multipliers', function (Blueprint $table) {
            $table->id();
            $table->integer('2_combination')->nullable();// 
            $table->integer('3_combination')->nullable();
            $table->integer('4_combination')->nullable();
            $table->integer('5_combination')->nullable();
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
        Schema::dropIfExists('multipliers');
    }
}
