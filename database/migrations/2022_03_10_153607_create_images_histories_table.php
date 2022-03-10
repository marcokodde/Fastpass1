<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_history', function (Blueprint $table) {
            $table->id();
            $table->string('vin',25)->nullable()->default(null)->comment('VIN');
            $table->string('stock',20)->nullable()->default(null)->comment('Id Stock');
            $table->mediumText('images')->nullable()->default(null)->comment('URL para la imagen principal');
            $table->boolean('is_available_inventory')->nullable()->default(1)->comment('¿Está en disponbile en el inventario');
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
        Schema::dropIfExists('images_histories');
    }
}
