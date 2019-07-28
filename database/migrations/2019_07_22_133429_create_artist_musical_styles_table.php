<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistMusicalStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_musical_styles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('artist_id')->unsigned();
            $table->foreign('artist_id')->
                references('id')->
                on('artists');
            $table->bigInteger('music_style_id')->unsigned();
            $table->foreign('music_style_id')->
                references('id')->
                on('music_styles');
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
        Schema::dropIfExists('artist_musical_styles');
    }
}
