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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto');
            $table->integer('cantidad');
            $table->boolean('estado');
            $table->string('foto_producto');
            $table->foreignId('id_marcas')->constrained('marcas');
            $table->foreignId('id_categorias')->constrained('categorias');
            $table->foreignId('id_proveedors')->constrained('proveedors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
