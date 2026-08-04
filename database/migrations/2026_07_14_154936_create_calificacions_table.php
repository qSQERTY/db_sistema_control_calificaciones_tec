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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla examenes
            $table->foreignId('examen_id')
                  ->constrained('examenes')
                  ->onDelete('cascade');

            // Examen de ubicación
            $table->string('nivel_ubicacion')->nullable();

            // Examen de 4 habilidades
            $table->decimal('reading', 5, 2)->nullable();
            $table->decimal('listening', 5, 2)->nullable();
            $table->decimal('writing', 5, 2)->nullable();
            $table->decimal('speaking', 5, 2)->nullable();
            $table->decimal('promedio', 5, 2)->nullable();

            // TOEFL
            $table->decimal('toefl', 5, 2)->nullable();

            // Speaking por certificación
            $table->decimal('speaking_certificacion', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};