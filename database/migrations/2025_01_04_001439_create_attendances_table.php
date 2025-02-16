<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // Relación con el usuario
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relación con la suscripción activa en el momento de la asistencia
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            // Fecha y hora de la asistencia
            $table->dateTime('attended_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
