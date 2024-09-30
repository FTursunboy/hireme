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
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->unsignedBigInteger('tg_id')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->decimal('min_service_cost')->nullable();
            $table->text('service_description')->nullable();
            $table->string('password')->nullable();
            $table->string('state')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
