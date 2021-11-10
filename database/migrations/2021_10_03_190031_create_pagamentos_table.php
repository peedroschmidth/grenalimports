<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->double('valor');
            $table->string('tipo');
            $table->integer('venda_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('venda_id')->references('id')->on('vendas');
            $table->integer('encomenda_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('encomenda_id')->default()->references('id')->on('encomendas');
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
        Schema::dropIfExists('pagamentos');
    }
}
