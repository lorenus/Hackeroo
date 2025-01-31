<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_dni'); 
            $table->foreign('usuario_dni')->references('DNI')->on('usuarios')->onDelete('cascade');
            $table->foreignId('pregunta_id')->constrained('preguntas')->onDelete('cascade'); // Relación con la pregunta
            $table->text('respuesta'); // Respuesta dada por el alumno
            $table->boolean('es_correcta')->nullable(); // Opcional: si la respuesta es correcta
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
