<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaTable extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla // create table.
     * @return void
     */
    public function up()
    {
        Schema::create('moneda', function (Blueprint $table)
        {
            $table->id(); // id autonumerico
            
            $table->string('nombre', 60);
            $table->string('simbolo', 8);
            $table->string('pais', 80);
            $table->decimal('valor', 5, 3);
            $table->date('fecha')->nullable();
            
            $table->timestamps();
            
            // restriccion para que sean unicos.
            $table->unique(['nombre', 'pais']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneda');
    }
}
