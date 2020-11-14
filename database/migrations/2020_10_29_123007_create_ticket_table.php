<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla // create table.
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) 
        {
            $table->id(); // biInteger autonumerico, unsigned.
            
            // Aqui se definen todos los campos de la tabla, entre el id y el timestamps.
            // Este campo tiene que ser bigInteger para referenciar al id de la empresa.
            $table->bigInteger('identerprise')->unsigned();
            
            $table->string('name', 80);
            $table->decimal('price', 6, 2);
            $table->date('initialdate');
            $table->date('finaldate');
            $table->time('initialtime');
            $table->time('finaltime');
            $table->boolean('active')->default(true);
            $table->text('description')->nullable();
            $table->decimal('profit', 4, 1)->default(15.0);
            
            // fecha de creaacion y edicion de la tabla.
            $table->timestamps();
            
            // Aqui definimos la relacion entre ticket y enterprise
            $table->foreign('identerprise')->references ('id')->on('enterprise');
            
            // restriccion.
            $table->unique(['identerprise', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     * // borra la tabla // drop table.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
