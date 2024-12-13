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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100);
            $table->integer('cantidad');
            $table->decimal('precio_unitario',10,2);
            $table->string('foto',30);
            $table->foreignId('unidades_id')->references('id')->on('unidades');
            $table->foreignId('categorias_id')->references('id')->on('categorias');
            $table->integer('alerta_minima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
