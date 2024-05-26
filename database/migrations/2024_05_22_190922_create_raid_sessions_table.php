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
        Schema::create('raid_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('name')->nullable();
            $table->string('server')->nullable();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('master_code_id')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamps();

            $table->foreign('master_code_id')->references('id')->on('codes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raid_sessions');
    }
};
