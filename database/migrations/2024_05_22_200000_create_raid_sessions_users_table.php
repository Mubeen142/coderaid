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
        Schema::create('raid_sessions_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raid_session_id');
            $table->unsignedBigInteger('current_code_id')->nullable();
            $table->string('nickname')->nullable();
            $table->string('avatar');
            $table->integer('total_guess_count')->default(0);
            $table->ipAddress('ip_address');
            $table->timestamp('started_at')->nullable();
            $table->timestamps();

            $table->foreign('raid_session_id')->references('id')->on('raid_sessions')->onDelete('cascade');
            $table->foreign('current_code_id')->references('id')->on('codes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raid_sessions_users');
    }
};
