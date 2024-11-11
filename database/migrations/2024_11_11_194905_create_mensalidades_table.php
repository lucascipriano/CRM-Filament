<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Adicionando o campo user_id
            $table->unsignedBigInteger('filiado_id');
            $table->foreign('filiado_id')->references('id')->on('filiados')->onDelete('cascade');
            $table->decimal('valor', 8, 2);
            $table->date('data_referencia');
            $table->boolean('pago')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensalidades');
    }
};
