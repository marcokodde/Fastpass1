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
<<<<<<<< HEAD:database/migrations/2022_02_24_000000_create_clients_table.php
            $table->integer('loggin_times')->default(0);
========
            $table->integer('loggin_times')->default(0)->comment('Vecese que ha ingresado');
>>>>>>>> ad846dbf98090509e31d58834ae4d88cfc1879e9:database/migrations/2022_02_24_172000_create_clients_table.php
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
