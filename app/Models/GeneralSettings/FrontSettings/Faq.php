<?php

namespace App\Models\GeneralSettings\FrontSettings;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
