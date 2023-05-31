<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resenyas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido');
            $table->text('nombreyapellido');
            
            $table->unsignedBigInteger("user_id")->nullable();
            $table->timestamps();
            $table->integer('puntuacion');
            $table->binary("imagen")->nullable();
            $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');//El enlace de fk
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resenyas');
    }
};
