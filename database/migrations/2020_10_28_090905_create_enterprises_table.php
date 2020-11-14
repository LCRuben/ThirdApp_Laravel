<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table) 
        {
            $table->id();
            
            // Aqui se definen todos los campos de la tabla, entre el id y el timestamps
            $table->string('name', 60)->unique();
            $table->string('phone', 15);
            $table->string('contactperson', 100);
            $table->text('address');
            $table->string('taxnumber', 20);
            
            // fecha de creacion y edicion de la tabla.
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
        Schema::dropIfExists('enterprise');
    }
}
