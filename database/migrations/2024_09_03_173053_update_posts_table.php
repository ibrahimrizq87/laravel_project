<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn('salary_range');

            $table->bigInteger('s_from')->nullable();
            $table->bigInteger('s_to')->nullable();

            $table->enum('status', ['pended', 'canceled', 'approved'])->default('pended');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->string('salary_range')->nullable();
            $table->dropColumn(['s_from', 's_to', 'status']);
        });
    }
};
