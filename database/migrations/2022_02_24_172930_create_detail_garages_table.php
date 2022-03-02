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
            $table->foreignId('garage_id')->constrained('garages');
            $table->string('dealer_id',15)->comment('Id distribuidor');
            $table->string('vin',25)->nullable()->default(null)->comment('VIN');
            $table->string('stock',20)->nullable()->default(null)->comment('Id Stock');
            $table->year('year')->nullable()->default(null)->comment('Axo');
            $table->string('make',20)->nullable()->comment('Marca');
            $table->string('model',25)->nullable()->default(null)->comment('Modelo');
            $table->string('exterior_color',100)->nullable()->default(null)->comment('Color Exterior');
            $table->string('interior_color',100)->nullable()->default(null)->comment('Color Interior');
            $table->integer('mileage')->nullable()->default(0)->comment('millas');
            $table->string('transmission',40)->nullable()->default(null)->comment('Transmision');
            $table->string('engine',100)->nullable()->default(null)->comment('Motor');
            $table->integer('retail_price')->nullable()->default(0)->comment('Precio Oferta');
            $table->integer('sales_price')->nullable()->default(0)->comment('Precio Venta');
            $table->string('options',2)->nullable()->default(null)->comment('OPciones');
            $table->mediumText('images')->nullable()->default(null)->comment('URL para la imagen principal');
            $table->dateTimeTz('last_updated', $precision = 0)->nullable()->default(now())->comment('Ultima actualizacion');
            $table->string('body',100)->nullable()->default(null)->comment('Body');
            $table->string('trim',100)->nullable()->default(null)->comment('Trim');
            $table->boolean('is_additional_next_tier')->default(0)->comment('¿Es de enganche adicional');
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
