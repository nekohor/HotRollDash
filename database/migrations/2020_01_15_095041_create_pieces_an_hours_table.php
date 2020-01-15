<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecesAnHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces_an_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line');
            $table->string('steel_grade_catego');
            $table->double('thk_gte');
            $table->double('thk_lt');
            $table->integer('wid_gte');
            $table->integer('wid_lt');
            $table->integer('pieces_an_hour');
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
        Schema::dropIfExists('pieces_an_hours');
    }
}
