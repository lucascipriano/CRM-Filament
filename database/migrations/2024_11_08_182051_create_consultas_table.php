<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relaciona com o usuário que criou a consulta
            $table->unsignedBigInteger('cliente_id'); // Relaciona com o cliente da consulta
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->text('description')->nullable(); // Local para descrição
            $table->text('guidance')->nullable(); // Local para orientações
            $table->date('return_date')->nullable(); // Data de retorno
            $table->decimal('consultation_fee', 8, 2)->nullable(); // Valor da consulta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
