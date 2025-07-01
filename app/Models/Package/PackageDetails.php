<?php

namespace App\Models\Package;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['package_id', 'name', 'value'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
