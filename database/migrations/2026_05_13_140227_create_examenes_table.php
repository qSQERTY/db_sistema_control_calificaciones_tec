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
        Schema::create('examenes', function (Blueprint $table) {

            $table->id();


            $table->foreignId('estudiante_id')
                  ->constrained('estudiantes')
                  ->onDelete('cascade');


            $table->foreignId('anio_id')
                  ->constrained('anios')
                  ->onDelete('cascade');


            $table->string('tipo_examen');


            $table->integer('intento');


            $table->boolean('pago')
                  ->default(false);


            $table->date('fecha');


            $table->string('folio')
                  ->unique();


            $table->string('comprobante_pago')
                  ->nullable();


            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examenes');
    }
};