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
<<<<<<< HEAD
            $table->string('token',100)->nullable();
=======
            $table->string('token',100)->nullable()->default(null);
>>>>>>> ad846dbf98090509e31d58834ae4d88cfc1879e9
            $table->timestamp('start_at')->nullable()->default(null);
            $table->timestamp('expire_at')->nullable()->default(null);
            $table->boolean('generated_by_system')->default(0);
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
