<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->foreignId('purchase_package_id')->constrained('purchase_packages')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('bill_type')->nullable();
            $table->date('bill_date')->nullable();
            $table->date('billing_month');
            $table->date('last_payment_date')->nullable();
            $table->date('due_date');
            $table->enum('status', ['pending', 'paid', 'payment_pending', 'overdue', 'cancelled'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
