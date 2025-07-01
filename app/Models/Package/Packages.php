<?php

namespace App\Models\Package;

use Illuminate\Support\Str;
use App\Models\PackageRequest;
use App\Models\PurchasePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
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

    public function packageCategory(){
        return $this->belongsTo(PackageCategory::class, 'package_catgory_id', 'id');
    }

    public function packageDetails(){
        return $this->hasMany(PackageDetails::class, 'package_id');
    }

    public function packageRequests(){
        return $this->hasMany(PackageRequest::class, 'package_id');
    }

    public function purchasePackages(){
        return $this->hasMany(PurchasePackage::class, 'package_id');
    }
}
