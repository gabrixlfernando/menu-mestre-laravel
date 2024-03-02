<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('pedidos', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('mesa_id');
        //     $table->unsignedBigInteger('produto_id');
        //     $table->integer('quantidade');
        //     $table->decimal('preco_unitario', 10, 2);
        //     $table->decimal('total_item', 10, 2);
        //     $table->timestamps();

        //     $table->foreign('mesa_id')->references('id')->on('mesas')->onDelete('cascade');
        //     $table->foreign('produto_id')->references('idProduto')->on('tblprodutos')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
