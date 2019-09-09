<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add4ImagesToProfessionals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->string('imagepath2')->nullable();
            $table->string('imagepath3')->nullable();
            $table->string('imagepath4')->nullable();
            $table->string('imagepath5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn('imagepath2');
            $table->dropColumn('imagepath3');
            $table->dropColumn('imagepath4');
            $table->dropColumn('imagepath5');
        });
    }
}
