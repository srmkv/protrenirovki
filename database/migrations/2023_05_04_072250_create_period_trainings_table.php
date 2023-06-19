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
        Schema::create('period_trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_day_id');
            $table->string('name')->nullable();
            $table->timestamps();

            $table->foreign('training_day_id')
                ->references('id')->on('training_days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_trainings');
    }
};
