<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableModalidadesProfessores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidades_professores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('professor_id')->unsigned();
            $table->integer('modalidade_id')->unsigned();
            $table->foreign('modalidade_id')->references('id')->on('modalidades')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');
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
        Schema::dropIfExists('modalidades_professores');
    }
}
