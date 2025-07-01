<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('potential_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->integer('is_active')->default(1);
            $table->string('otp')->nullable();
            $table->string('otp_time')->nullable();
            $table->timestamps();
            $table->uuid('uuid')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potential_customers');
    }
};
