<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionesRespuestasTable extends Migration
{
    public function up()
    {
        Schema::create('opciones_respuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pregunta_id')->constrained('preguntas')->onDelete('cascade');
            $table->text('respuesta'); // Texto de la respuesta
            $table->boolean('es_correcta')->default(false); // Indica si es la respuesta correcta
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opciones_respuestas');
    }
}

