<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('gender', ['male', 'female']);
            $table->string('birthdate');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['birthdate', 'gender']);
        });
    }
};
