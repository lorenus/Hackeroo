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
            $table->unsignedBigInteger('pregunta_id');        
            $table->text('respuesta'); // Texto de la respuesta
            $table->boolean('es_correcta')->default(false); // Indica si es la respuesta correcta
            $table->timestamps();
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('opciones_respuestas');
    }
}

