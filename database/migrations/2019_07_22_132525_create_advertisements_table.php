<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->
                references('id')->
                on('users');
            $table->string('embedded_type');
            $table->bigInteger('embedded_id');
            $table->bigInteger('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->
                references('id')->
                on('estados');
            $table->bigInteger('cidade_id')->unsigned()->nullable();
            $table->foreign('cidade_id')->
                references('id')->
                on('cidades');
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
        Schema::dropIfExists('advertisements');
    }
}
