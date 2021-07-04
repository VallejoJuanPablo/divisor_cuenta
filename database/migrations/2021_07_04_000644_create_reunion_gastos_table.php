<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunion_gastos', function (Blueprint $table) {
            $table->id();
            $table->string('id_reunion')->nullable(); 
            $table->string('codigo');
            $table->string('dni');
            $table->string('nombre');
            $table->string('monto');
            $table->string('descripcion');
            $table->string('estado');
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
        Schema::dropIfExists('reunion_gastos');
    }
}
