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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('min_service_cost')->nullable();
            $table->text('service_description')->nullable();
            $table->string('state')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('archived')->default(false);
            $table->dateTime('archived_at')->nullable();
            $table->string('status')->default(\App\Enum\ModerationStatuses::Moderation);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
