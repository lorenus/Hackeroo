<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosMultimediaTable extends Migration
{
    public function up()
    {
        Schema::create('recursos_multimedia', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Tipo de recurso (imagen, video, enlace)
            $table->string('url'); // URL del recurso
            $table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade'); // Relación con tareas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recursos_multimedia');
    }
}

