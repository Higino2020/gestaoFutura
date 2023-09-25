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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nome');
            $table->string('foto')->nullable();
            $table->enum('medicao',['Caixa','Kilograma','Unidade']);
            $table->integer('qtdaVender')->default(0);
            $table->integer('qtd')->default(0);;
            $table->double('preco',9,2)->default(0);
            $table->date('caducidade')->nullable();
            $table->enum('perecivel',['Sim','Não']);
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
