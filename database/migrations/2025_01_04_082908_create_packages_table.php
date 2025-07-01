<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_catgory_id');
            $table->string('plan_name');
            $table->string('title')->nullable();
            $table->string('speed')->nullable();
            $table->string('monthly_cost');
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
            $table->uuid('uuid')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
