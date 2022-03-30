<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_id',50)->comment('Id Cliente Neo');
            $table->float('downpayment', 8, 2)->default(0)->comment('Enganche Inicial');
            $table->integer('loggin_times')->default(0)->comment('Vecese que ha ingresado');
            $table->integer('expired_sessions')->default(0)->comment('Vecese que le han expirado las sesiones');
            $table->integer('times_loggin')->default(0)->comment('Vecese que ha ingresado nuevo control');
            $table->integer('active_sessions')->default(0)->comment('Sesiones Activas');
            $table->dateTime('date_at', $precision = 0)->nullable()->default(null)->comment('Fecha y hora de cita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
