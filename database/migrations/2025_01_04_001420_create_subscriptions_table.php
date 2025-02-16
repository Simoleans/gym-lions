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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            // Relación con usuario (cliente)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relación con plan
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            // Fecha de inicio y fin de la suscripción (opcional, depende de tu lógica)
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            // Clases restantes en el mes actual (o ciclo actual)
            $table->integer('remaining_classes')->nullable();
            // Estado de la suscripción
            $table->enum('status', ['active', 'inactive', 'canceled'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
