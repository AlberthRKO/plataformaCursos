<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Modelos
use App\Models\Course;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            /* 
             *creamos un campo de tipo enum para el estado asignando un valor por defecto
             * 1 = estado en borrador
             * 2 = estado en revision
             * 3 = estado en publicado
            */
            $table->enum('status', [Course::borrador, Course::revision, Course::publicado])->default(Course::borrador);
            // para generar nuestras urls amigables
            $table->string('slug');


            //* llave foraneas
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('price_id')->nullable();

            //* hacemos referencia del campo con la tabla
            //! si un usuario se da de baja se eliminara todo su contenido poniendo onDelete('cascade')
            //! si un level,category o price se elimina todo su contenido de cursos pasara a un id nulo poniendo onDelete('set null') para eso debe aceptar nulos la columna
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
