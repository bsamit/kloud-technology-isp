<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_details', function (Blueprint $table) {
            $table->id();
            $table->string('package_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->uuid('uuid')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_details');
    }
};
