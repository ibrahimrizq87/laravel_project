<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->text('description');
            $table->text('responsibilities');
            $table->text('required_skills');
            $table->text('qualifications');
            $table->string('salary_range');
            $table->text('benefits_offered')->nullable();
            $table->string('location');

            $table->enum('work_type', ['full-time', 'part-time', 'freelancing-job']);

            $table->enum('work_from', ['remote', 'on-site', 'hybrid']);

            $table->date('application_deadline');
            $table->date('date');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};


