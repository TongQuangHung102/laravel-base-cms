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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique(); // Level 2
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['registered', 'user', 'admin'])->default('user'); // Level 1

            // Thông tin nâng cao - Level 1 & 2
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('slogan')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Level 2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
