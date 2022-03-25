<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_garages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id')->constrained('garages')->comment('Id del garage');
            $table->foreignId('inventory_id')->constrained('inventories')->comment('Id en Inventario');
            $table->string('dealer_id',15)->comment('Id distribuidor');
            $table->string('vin',25)->nullable()->default(null)->comment('VIN');
            $table->string('stock',20)->nullable()->default(null)->comment('Id Stock');
            $table->integer('retail_price')->nullable()->default(0)->comment('Precio Oferta');
            $table->integer('sales_price')->nullable()->default(0)->comment('Precio Venta');
            $table->mediumText('images')->nullable()->default(null)->comment('URL para la imagen principal');
            $table->boolean('is_additional_next_tier')->nullable()->default(0)->comment('¿Es de enganche adicional');
            $table->boolean('is_available_inventory')->nullable()->default(1)->comment('¿Está en disponbile en el inventario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_garages');
    }
};
