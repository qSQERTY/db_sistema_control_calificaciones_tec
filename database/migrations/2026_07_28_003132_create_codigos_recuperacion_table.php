<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codigos_recuperacion', function (Blueprint $table) {

            $table->id();

            $table->string('email');

            $table->string('codigo');

            $table->timestamp('expira_en');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codigos_recuperacion');
    }
};
