<?php

namespace App\Models\GeneralSettings\FrontSettings;

use App\Models\FrontSettings\ServiceDetails;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
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

    public function serviceDetails(){
        return $this->hasMany(ServiceDetails::class, 'service_id');
    }
}
