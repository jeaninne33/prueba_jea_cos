<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //SE CREA LA TABLA DE LOS PAISES 
        Schema::create('paises', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        }); 

        //SE CREA LA TABLA DE DEPARTAMENTOS CON LA RELACION A PAIS
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedInteger('pais_id');
            $table->foreign('pais_id')
            ->references('id')->on('paises')
            ->onDelete('NO ACTION');
            $table->timestamps();
        });
         //SE CREA LA TABLA DE MUNICIPIOS QUE PERTENECEN A UN PAIS
         Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedInteger('departamento_id');
            $table->foreign('departamento_id')
            ->references('id')->on('departamentos')
            ->onDelete('NO ACTION');
            $table->timestamps();
        });
        //SE CREA LA TABLA DE LOS USUARIOS CON LA RELACION A MUNICIPIO
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('direccion');//se añade el campo direccion como obligatorio
            $table->string('telefono')->nullable();// se añade el campo telefono como opcional
            $table->unsignedInteger('municipio_id');
            $table->foreign('municipio_id')
                ->references('id')
                ->on('municipios')
                ->onDelete('NO ACTION');
            $table->rememberToken();
            $table->timestamps();
        });
        //SE CREA LA TABLA PARA LOS ENVIOS DE CORREOS
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('destinatario');
            $table->string('asunto');
            $table->text('mensaje');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
            ->references('id')->on('users');
            $table->boolean('enviado')->default(0)->comment('0: indica no enviado, 1:indica enviado');
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
        Schema::dropIfExists('emails');
        Schema::dropIfExists('users');
        Schema::dropIfExists('municipios');
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('paises');
    }
}
