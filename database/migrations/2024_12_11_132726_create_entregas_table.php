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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encargos_id')->references('id')->on('encargos');
            $table->foreignId('ventas_id')->references('id')->on('ventas');
            $table->decimal('total',10,2);
            $table->decimal('precio',10,2);
            $table->date('fecha_pago');
            $table->foreignId('metodo_pagos_id')->references('id')->on('metodo_pagos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
