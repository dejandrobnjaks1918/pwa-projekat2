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
        Schema::create('equipment_rental', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->foreignId('rental_id')->constrained()->onDelete('cascade');
        $table->foreignId('extra_equipment_id')->constrained('extra_equipment')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_rental');
    }
};
