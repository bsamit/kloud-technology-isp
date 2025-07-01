<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('mobile')->nullable()->unique();
            $table->integer('role_id')->nullable();
            $table->integer('gender_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nid')->nullable();
            $table->double('salary')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('address')->nullable();
            $table->string('ref_details')->nullable();
            $table->integer('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->uuid('uuid')->unique();
        });

        User::create([
            'name' => 'Amit Saha',
            'email' => 'admin@gmail.com',
            'mobile' => '01733413080',
            'role_id' => 1,
            'gender_id' => 1,
            'nid' => '123-456-7890',
            'salary' => 10000.000,
            'father_name' => 'Super Admin Father Name',
            'mother_name' => 'Super Admin Mother Name',
            'address' => 'Admin Address',
            'status' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
