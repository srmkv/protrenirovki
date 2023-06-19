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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('inventory')->nullable();
            $table->string('base')->nullable();
            $table->string('insulating')->nullable();
            $table->string('masses')->nullable();
            $table->string('relief')->nullable();
            $table->string('muscle_group')->nullable();
            $table->string('back_pain')->nullable();
            $table->string('varicose')->nullable();
            $table->string('diastasis')->nullable();
            $table->string('knee_pain')->nullable();
            $table->string('high_pressure')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
