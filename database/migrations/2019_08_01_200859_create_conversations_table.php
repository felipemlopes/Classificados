<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('user_one')->unsigned()->nullable();
            $table->foreign('user_one')->
                references('id')->
                on('users')->
                onDelete('cascade');
            $table->bigInteger('user_two')->unsigned()->nullable();
            $table->foreign('user_two')->
                references('id')->
                on('users')->
                onDelete('cascade');
            $table->bigInteger('advertisement_id')->unsigned()->nullable();
            $table->foreign('advertisement_id')->
                references('id')->
                on('advertisements')->
                onDelete('cascade');
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
        Schema::dropIfExists('conversations');
    }
}
