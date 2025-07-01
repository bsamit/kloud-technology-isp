<?php

namespace App\Models\Helpdesk;

use App\Models\Package\Packages;
use Illuminate\Database\Eloquent\Model;
use App\Models\Helpdesk\HelpdeskCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        
    }
    
    public function ticket_replies() : HasMany
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }
    public function ticket_category(): BelongsTo
    {
        return $this->belongsTo(HelpdeskCategory::class, 'ticket_category_id');
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }

   
}
