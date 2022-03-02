<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestedVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggested_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clients');
            $table->foreignId('inventory_id')->constrained('inventories');
            $table->string('grade',1)->nullable()->comment('Grado de calificación');
            $table->float('downpayment_for_next_tier', 8, 2)->comment('Enganche Adicional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggested_vehicles');
    }
}
