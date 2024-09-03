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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();

            $table->string('skills')->nullable();
            $table->enum('employed', ['student', 'unemployed', 'employed'])->default('unemployed');

            $table->string('company')->nullable();
            $table->string('job_description')->nullable();
            // $table->string('cv')->nullable();
            $table->string('phone')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
