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
            $table->foreignId('client_id')->constrained('clients');
            $table->string('token',100)->nullable()->default(null);
            $table->timestamp('start_at')->nullable()->default(null);
            $table->timestamp('expire_at')->nullable()->default(null);
            $table->boolean('generated_by_system')->default(0);
            $table->boolean('active')->default(0);
            $table->integer('has_been_used')->default(0)->comment('¿Ha sido usado?');
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
