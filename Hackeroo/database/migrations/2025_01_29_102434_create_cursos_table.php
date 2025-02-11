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
        // Crear la tabla 'cursos'
        Schema::create('cursos', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre');
            $table->text('descripcion'); 
            $table->string('profesor_dni'); 
            $table->timestamps();

            $table->foreign('profesor_dni')->references('DNI')->on('usuarios')->onDelete('cascade');
        });

        Schema::create('curso_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained()->onDelete('cascade'); 
            $table->string('usuario_dni');
            $table->foreign('usuario_dni')->references('DNI')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_usuario'); 
        Schema::dropIfExists('cursos'); 
    }
};
