<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Package\PackageCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
            $table->uuid('uuid')->unique();
        });

        $data = [
            [
                'uuid' => Str::uuid(),
                'name' => 'Residential Packages',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Business Packages',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        PackageCategory::insert($data);
    }

    public function down(): void
    {
        Schema::dropIfExists('package_categories');
    }
};
