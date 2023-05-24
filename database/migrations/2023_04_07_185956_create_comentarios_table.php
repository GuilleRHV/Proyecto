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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("juego_id")->nullable();
            $table->biginteger("comentario_id");
            $table->unsignedBigInteger("padre_id")->nullable();
            $table->text("contenido");
            
         
            $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');//El enlace de fk
         
          
            $table->foreign('juego_id')->references('id')->on('games')->onDelete('cascade');//El enlace de fk

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
        Schema::dropIfExists('comentarios');
    }
};
