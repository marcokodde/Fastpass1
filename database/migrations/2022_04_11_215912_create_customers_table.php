<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('locator_id')->constrained('locators')->comment('Sucursal');
            $table->string('first_name',30)->comment('Nombre');
            $table->string('last_name',30)->comment('Apellido');
            $table->string('email',150)->comment('Correo Electrónico');
            $table->string('phone',15)->nullable()->comment('Teléfono');
            $table->foreignId('source_id')->constrained('sources')->comment('Fuente');
            $table->foreignId('reason_id')->constrained('reasons')->comment('Motivo');
            $table->enum('attention_mode',['Seller','Online'])->default('Seller')->comment('Modo de Atención');
            $table->timestamp('check_in')->nullable()->default(null)->comment('Hora de llegada');
            $table->integer('shift')->nullable()->comment('Turno para ser atendido');
            $table->timestamp('check_out')->nullable()->default(null)->comment('Hora de salida');
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
        Schema::dropIfExists('customers');
    }
}
