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
            $table->foreignId('dealer_id')->constrained('dealers')->comment('Distribuidor');
            $table->foreignId('client_id')->constrained('clients')->comment('Cliente');
            $table->foreignId('inventory_id')->constrained('inventories')->comment('Inventario');
            $table->float('sale_price', 8, 2)->default(0)->comment('Precio de venta');
            $table->string('grade',1)->nullable()->comment('Grado de calificación');
            $table->float('downpayment_for_next_tier', 8, 2)->comment('Enganche Adicional');
            $table->boolean('show_like_additional')->default(0)->comment('¿Mostrar vehículo como adicional?');
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
