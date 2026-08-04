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
    if (Schema::hasColumn('calificaciones', 'calificacion_ubicacion')) {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->dropColumn('calificacion_ubicacion');
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    if (!Schema::hasColumn('calificaciones', 'calificacion_ubicacion')) {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->decimal('calificacion_ubicacion', 5, 2)->nullable();
        });
    }
}
};