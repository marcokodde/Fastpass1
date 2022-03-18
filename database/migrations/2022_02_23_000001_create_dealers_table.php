<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->comment('Dealer name');
            $table->float('percentage', 5, 2)->default(env('APP_PERCENTAGE_DEALER',7.00))->comment('Percentaje to calculate mininum downpayment');
            $table->boolean('open_sunday')->default(1)->comment('¿Abre los domingos?');
            $table->integer('hour_opening')->nullable()->default(null)->comment('Hora que abre');
            $table->integer('hour_closing')->nullable()->default(null)->comment('Hora que cierre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealers');

    }
}
