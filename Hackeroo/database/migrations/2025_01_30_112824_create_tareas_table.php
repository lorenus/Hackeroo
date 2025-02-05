<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('tipo', ['test', 'archivo', 'link']);
            $table->integer('numero_preguntas')->nullable(); 
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade'); // Relación con cursos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}


