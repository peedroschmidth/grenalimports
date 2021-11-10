<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('genero');
            $table->string('ano');
            $table->string('personalizacao')->nullable()->default(NULL);
            $table->string('observacao')->nullable()->default(NULL);
            $table->integer('estoque')->nullable()->default(0);
            $table->integer('clube_id')->unsigned();
            $table->foreign('clube_id')->references('id')->on('clubes');
            $table->integer('cor_id')->unsigned();
            $table->foreign('cor_id')->references('id')->on('cors');
            $table->integer('descricao_id')->unsigned();
            $table->foreign('descricao_id')->references('id')->on('descricaos');
            $table->integer('tamanho_id')->unsigned();
            $table->foreign('tamanho_id')->references('id')->on('tamanhos');
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
        Schema::dropIfExists('produtos');
    }
}
