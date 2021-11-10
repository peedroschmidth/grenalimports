<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('apelido')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable()->default(NULL);
            $table->integer('qtdcompras')->default(0);
            $table->string('endereco')->nullable()->default(NULL);
            $table->string('cidade')->nullable()->default(NULL);
            $table->string('estado')->nullable()->default(0);
            $table->string('cep')->nullable()->default(NULL);
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
        Schema::dropIfExists('clientes');
    }
}
