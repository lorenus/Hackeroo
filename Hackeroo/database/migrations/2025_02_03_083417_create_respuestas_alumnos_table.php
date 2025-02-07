<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasAlumnosTable extends Migration
{
    public function up()
    {
        Schema::create('respuestas_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pregunta_id')->constrained('preguntas')->onDelete('cascade');
            $table->string('usuario_dni');
            $table->foreign('usuario_dni')->references('dni')->on('usuarios')->onDelete('cascade');
            $table->foreignId('opcion_respuesta_id')->constrained('opciones_respuestas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('respuestas_alumnos');
    }
}
