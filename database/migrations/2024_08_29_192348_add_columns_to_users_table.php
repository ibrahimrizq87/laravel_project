<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->enum('role', ['admin', 'candidate', 'employer']);
//             $table->string('image')->nullable();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->dropColumn(['role', 'image']);
//         });
//     }
// };



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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'candidate', 'employer']);
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Add the gender column
            $table->date('birthdate')->nullable(); // Add the birthdate column if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'image', 'gender', 'birthdate']); // Drop the gender and birthdate columns as well
        });
    }
};
