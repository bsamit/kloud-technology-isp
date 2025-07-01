<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bill_id',
        'user_id',
        'amount',
        'payment_method',
        'transaction_id',
        'payment_proof',
        'status',
        'payment_date',
        'approved_by',
        'notes'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_BANK = 'bank_transfer';
    const PAYMENT_METHOD_MOBILE = 'mobile_banking';

    const PAYMENT_METHODS = [
        self::PAYMENT_METHOD_CASH,
        self::PAYMENT_METHOD_BANK,
        self::PAYMENT_METHOD_MOBILE,
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'approved_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}