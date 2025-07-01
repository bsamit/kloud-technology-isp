<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\GeneralSettings\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('company_main_logo')->nullable();
            $table->string('company_mini_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('copy_right_text');
            $table->timestamps();
        });

        SiteSetting::create([
            'company_name' => 'Nationwide ISP',
            'mobile' => '+8801710000000',
            'email' => 'email@gmail.com',
            'address' => 'Nationwide ISP, Dhaka, Bangladesh',
            'company_main_logo' => 'images\site\logo.png',
            'company_mini_logo' => NULL,
            'copy_right_text' => '© 2025 Nationwide ISP. All Rights Reserved.',
        ]);
    }


    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
