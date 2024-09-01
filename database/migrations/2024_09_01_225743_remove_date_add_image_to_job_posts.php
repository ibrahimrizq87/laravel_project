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
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('date');
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->string('image')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->date('date')->nullable();
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->dropColumn('image');
        });
    }
};
