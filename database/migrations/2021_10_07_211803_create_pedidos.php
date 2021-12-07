<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->default(NULL);
            $table->foreignId('codigo_cliente')->constrained('cliente')->default(NULL);
            $table->foreignId('codigo_unidade')->constrained('unidade')->default(Null);
            $table->string('codigo_produto')->default(NULL);
            $table->date('data');
            $table->string('referencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido');
    }
}
