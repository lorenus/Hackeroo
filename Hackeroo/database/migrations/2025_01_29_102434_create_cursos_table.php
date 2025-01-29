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
            $table->id(); // ID único del curso
            $table->string('nombre'); // Nombre del curso
            $table->text('descripcion'); // Descripción del curso
            $table->string('profesor_dni'); // Clave foránea para el profesor (DNI)
            $table->timestamps(); // Tiempos de creación y actualización

            // Relación con el profesor
            $table->foreign('profesor_dni')->references('DNI')->on('usuarios')->onDelete('cascade');
        });

        // Crear la tabla intermedia 'curso_usuario' para la relación muchos a muchos
        Schema::create('curso_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained()->onDelete('cascade'); // Relación con la tabla 'cursos'
            $table->string('usuario_dni'); // Clave foránea hacia 'usuarios' (DNI del alumno)
            $table->foreign('usuario_dni')->references('DNI')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_usuario'); // Eliminar la tabla intermedia
        Schema::dropIfExists('cursos'); // Eliminar la tabla 'cursos'
    }
};
