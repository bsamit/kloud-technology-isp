<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_packages', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('package_id');
            $table->integer('amount');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('last_payment_date');
            $table->decimal('monthly_fee', 10, 2)->nullable();
            $table->decimal('setup_fee', 10, 2)->nullable();
            $table->integer('status')->default(1);
            $table->integer('created_by')->nullable(1);
            $table->uuid('uuid')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_packages');
    }
};
