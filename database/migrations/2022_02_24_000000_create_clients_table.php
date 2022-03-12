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
            $table->boolean('read_vehicles_from_api')->default(1)->comment('Read Api');
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
