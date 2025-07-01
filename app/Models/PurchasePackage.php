<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Package\Packages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchasePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'start_date',
        'end_date',
        'monthly_fee',
        'setup_fee',
        'last_payment_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'last_payment_date' => 'datetime',
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
