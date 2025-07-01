<?php

namespace App\Models\Helpdesk;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HelpdeskCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();
        
    }
}

