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
        Schema::create('client_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('client_id',50);
            $table->timestamp('start_at')->nullable()->default(null);
            $table->timestamp('expire_at')->nullable()->default(null);
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('client_sessions');
    }
};
