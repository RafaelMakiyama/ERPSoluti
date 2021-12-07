<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->foreignId('codigo_pedido')->constrained('pedido')->default(null);
            $table->string('sequencia');
            $table->string('nome');
            $table->integer('qtdvendida');
            $table->integer('qtdentregue');
            $table->string('campo1');
            $table->string('campo2');
            $table->string('campo3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
