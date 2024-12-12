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
        Schema::create('encargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientes_id')->references('id')->on('clientes');
            $table->string('descripcion_articulo',200);
            $table->integer('cantidad');
            $table->date('fecha_encargo');
            $table->enum('estado',['pendiente','en_proceso','completado','cancelado']);
            $table->string('observaciones',200);
            $table->date('fecha_entrega');
            $table->string('foto',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encargos');
    }
};
