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
        Schema::create('streetlights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('lat');
            $table->float('long');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('model')->nullable();
            $table->unsignedFloat('height')->nullable();
            $table->unsignedInteger('power_rate')->nullable();
            $table->string('voltage_rate')->nullable();
            $table->unsignedInteger('illumination_level')->nullable();
            $table->string('manufacturer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streetlights');
    }
};
