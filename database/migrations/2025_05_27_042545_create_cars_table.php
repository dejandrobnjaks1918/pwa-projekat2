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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->decimal('price_per_day', 8, 2);
            $table->enum('transmission', ['Manuelni', 'Automatski']);
            $table->enum('fuel', ['Benzin', 'Dizel', 'Elektricni', 'Hibrid']);
            $table->enum('category', ['Malo vozilo', 'Srednje vozilo', 'Veliko vozilo']);
            $table->boolean('featured')->default(false);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
