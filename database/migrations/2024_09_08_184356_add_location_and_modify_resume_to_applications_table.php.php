<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Adding a new column 'location' after 'phone_number'
            // $table->string('location')->after('phone_number');

            // Modifying the 'resume' column to be nullable
            // $table->unsignedBigInteger('resume_id');
            // $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Dropping the 'location' column
            // $table->dropColumn(['location' ,'resume']);

        });
    }
};
