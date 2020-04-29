<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('time');
            $table->string('price');
            $table->string('time');
            $table->string('price');
            $table->string('time');
            $table->string('price');
            $table->string('time');
            $table->string('price');
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
        //
    }
}