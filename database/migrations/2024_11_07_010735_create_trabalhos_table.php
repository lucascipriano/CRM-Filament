<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabalhosTable extends Migration
{
    public function up()
    {
        Schema::create('trabalhos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tipo_de_trabalho')->nullable();
            $table->date('data_realizacao');
            $table->boolean('concluido')->default(false)->nullable();
            $table->text('descricao')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('trabalhos');
    }
}
