<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PurchasePackage;
use App\Models\Package\Packages;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    const BILL_TYPE_SETUP = 'setup_fee';
    const BILL_TYPE_MONTHLY = 'monthly_fee';

    const STATUS_PENDING = 'pending';
    const STATUS_PAYMENT_PENDING = 'payment_pending';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'package_id',
        'purchase_package_id',
        'amount',
        'bill_date',
        'billing_month',
        'due_date',
        'status',
        'payment_date',
        'last_payment_date',
        'payment_method',
        'transaction_id',
        'bill_type',
        'notes'
    ];

    protected $casts = [
        'bill_date' => 'datetime',
        'billing_month' => 'datetime',
        'due_date' => 'datetime',
        'payment_date' => 'datetime',
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

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function purchasePackage()
    {
        return $this->belongsTo(PurchasePackage::class);
    }
}